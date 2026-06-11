<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Assessment;
use App\Models\AssessmentCourseMapping;
use App\Models\Assessor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AssessorAssessmentService
{
    public function list(Assessor $assessor): Collection
    {
        return Application::query()
            ->where('assigned_assessor_id', $assessor->user_id)
            ->where('status', ApplicationStatus::UNDER_ASSESSMENT)
            ->with(['applicant.user', 'studyProgram', ])
            ->latest()
            ->get();
    }

    public function getById(int $applicationId, Assessor $assessor): Application
    {
        $application = Application::query()
            ->where('assigned_assessor_id', $assessor->user_id)
            ->with([
                'applicant.user',
                'studyProgram',
                'a1Courses',
                'a2LearningExperiences',
                'documents',
                'assessment.courseMappings.applicationA1Course',
                'assessment.courseMappings.applicationA2LearningExperience',
                'assessment.courseMappings.course',
            ])
            ->findOrFail($applicationId);

        if ($application->assessment) {
            $totalSKS = $application->assessment->courseMappings
                ->filter(fn($m) => $m->is_recognized && $m->course)
                ->sum(fn($m) => $m->course->sks ?? 0);

            $application->assessment->total_converted_sks = $totalSKS;
        }

        return $application;
    }

    public function createAssessment(int $applicationId, Assessor $assessor, array $data): Assessment
    {
        $application = Application::query()
            ->where('assigned_assessor_id', $assessor->user_id)
            ->where('status', ApplicationStatus::UNDER_ASSESSMENT)
            ->findOrFail($applicationId);

        if ($application->assessment) {
            abort(422, 'Assessment already exists.');
        }

        return Assessment::create([
            'application_id' => $application->id,
            'assessor_id'    => $assessor->id,
            'notes'          => $data['notes'] ?? null,
        ]);
    }

    public function storeCourseMapping(int $assessmentId, Assessor $assessor, array $data): AssessmentCourseMapping 
    {
        $assessment = Assessment::query()
            ->where('assessor_id', $assessor->id)
            ->with(['application.a1Courses', 'application.a2LearningExperiences',])
            ->findOrFail($assessmentId);

        /*
        |--------------------------------------------------------------------------
        | Validate A1 Ownership
        |--------------------------------------------------------------------------
        */

        if (! empty($data['application_a1_course_id'])) {

            $exists = $assessment
                    ->application
                    ->a1Courses()
                    ->where('id', $data['application_a1_course_id'])
                    ->exists();

            if (! $exists) {
                abort(422, 'Selected A1 course does not belong to this application.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Validate A2 Ownership
        |--------------------------------------------------------------------------
        */

        if (! empty($data['application_a2_learning_experience_id'])) {
            $exists =
                $assessment
                    ->application
                    ->a2LearningExperiences()
                    ->where('id', $data['application_a2_learning_experience_id'])
                    ->exists();

            if (! $exists) {
                abort(422, 'Selected learning experience does not belong to this application.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Source
        |--------------------------------------------------------------------------
        */

        if (! empty($data['application_a1_course_id'])) {
            $sourceAlreadyMapped = AssessmentCourseMapping::query()
                ->where('assessment_id', $assessment->id)
                ->where('application_a1_course_id', $data['application_a1_course_id'])
                ->exists();

            if ($sourceAlreadyMapped) {
                abort(422, 'Selected A1 course has already been mapped.');
            }
        }

        if (! empty($data['application_a2_learning_experience_id'])) {
            $sourceAlreadyMapped = AssessmentCourseMapping::query()
                ->where('assessment_id', $assessment->id)
                ->where('application_a2_learning_experience_id', $data['application_a2_learning_experience_id'])
                ->exists();

            if ($sourceAlreadyMapped) {
                abort(422, 'Selected learning experience has already been mapped.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Target Course
        |--------------------------------------------------------------------------
        */

        if (! empty($data['course_id'])) {
            $courseAlreadyMapped = AssessmentCourseMapping::query()
                    ->where('assessment_id', $assessment->id)
                    ->where('course_id', $data['course_id'])
                    ->exists();

            if ($courseAlreadyMapped) {
                abort(422, 'Target course has already been mapped.');
            }
        }

        return AssessmentCourseMapping::create([
            'assessment_id'                         => $assessment->id,
            'application_a1_course_id'              => $data['application_a1_course_id'] ?? null,
            'application_a2_learning_experience_id' => $data['application_a2_learning_experience_id'] ?? null,
            'course_id'                             => $data['course_id'] ?? null,
            'is_recognized'                         => $data['is_recognized'],
            'notes'                                 => $data['notes'] ?? null,
        ]);
    }

    public function updateCourseMapping(int $mappingId, Assessor $assessor, array $data) : AssessmentCourseMapping 
    {
        $mapping = AssessmentCourseMapping::query()
            ->whereHas('assessment', function ($query) use ($assessor) {
                    $query->where('assessor_id', $assessor->id);
                }
            )
            ->findOrFail($mappingId);

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Target Course
        |--------------------------------------------------------------------------
        */

        if (! empty($data['course_id'])) {
            $courseAlreadyMapped =
                AssessmentCourseMapping::query()
                    ->where('assessment_id', $mapping->assessment_id)
                    ->where('course_id',$data['course_id'])
                    ->where('id', '!=', $mapping->id)
                    ->exists();

            if ($courseAlreadyMapped) {
                abort(422, 'Target course has already been mapped.');
            }
        }

        $mapping->update([
            'course_id'     => $data['course_id'] ?? null,
            'is_recognized' => $data['is_recognized'],
            'notes'         => $data['notes'] ?? null,
        ]);

        return $mapping
            ->fresh()
            ->load(['applicationA1Course', 'applicationA2LearningExperience', 'course',]);
    }

    public function submitAssessment(int $assessmentId, Assessor $assessor): Assessment
    {
        return DB::transaction(function () use ($assessmentId, $assessor) {
            $assessment = Assessment::with(['application', 'courseMappings.course'])
                ->where('assessor_id', $assessor->id)
                ->findOrFail($assessmentId);

            // Validasi: Jangan submit lagi jika sudah pernah submit
            if ($assessment->submitted_at !== null) {
                abort(422, 'Assessment has already been submitted.');
            }

            if ($assessment->courseMappings->isEmpty()) {
                abort(422, 'At least one mapping is required.');
            }

            // Hitung semua course yang di-recognized
            $recognizedMappings = $assessment->courseMappings
                ->where('is_recognized', true)
                ->whereNotNull('course_id');

            // Total SKS yang berhasil dikonversi
            $totalSKS = $recognizedMappings->sum(fn($m) => $m->course->sks ?? 0);

            // Hitung rekomendasi
            $recognizedCount = $recognizedMappings->count();
            $recommendation = $recognizedCount > 0 ? 'pass' : 'fail';
            $applicationStatus = $recognizedCount > 0
                ? ApplicationStatus::ASSESSED
                : ApplicationStatus::REJECTED;

            // Update assessment
            $assessment->update([
                'recommendation' => $recommendation,
                'submitted_at'   => now(),
            ]);

            // Update application status
            $assessment->application->update([
                'status' => $applicationStatus,
            ]);

            // Load fresh data dulu, baru assign total SKS biar gak ke-reset
            $freshAssessment = $assessment->fresh()->load([
                'courseMappings.applicationA1Course',
                'courseMappings.applicationA2LearningExperience',
                'courseMappings.course',
                'application',
            ]);

            $freshAssessment->total_converted_sks = $totalSKS;

            return $freshAssessment;
        });
    }

    public function getCourseMappings(int $assessmentId, Assessor $assessor): Collection
    {
        $assessment = Assessment::query()
            ->whereHas('application', function ($query) use ($assessor) {
                $query->where('assigned_assessor_id', $assessor->user_id);
            })
            ->findOrFail($assessmentId);

        return $assessment->courseMappings()
            ->with([
                'applicationA1Course',
                'applicationA2LearningExperience',
                'course',
            ])
            ->latest()
            ->get();
    }
}