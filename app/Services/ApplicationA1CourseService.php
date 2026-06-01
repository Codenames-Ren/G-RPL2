<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Enums\RplType;

use App\Models\Application;
use App\Models\ApplicationA1Course;
use App\Models\Applicant;

use Illuminate\Database\Eloquent\Collection;

class ApplicationA1CourseService
{
    /**
     * Get all A1 courses.
     */
    public function list(
        int $applicationId,
        Applicant $applicant
    ): Collection {

        $application = $this->getApplication(
            $applicationId,
            $applicant
        );

        return $application
            ->a1Courses()
            ->latest()
            ->get();
    }

    /**
     * Get A1 course detail.
     */
    public function getById(
        int $applicationId,
        int $courseId,
        Applicant $applicant
    ): ApplicationA1Course {

        $this->getApplication(
            $applicationId,
            $applicant
        );

        return ApplicationA1Course::query()

            ->where(
                'application_id',
                $applicationId
            )

            ->findOrFail(
                $courseId
            );
    }

    /**
     * Create A1 course.
     */
    public function create(
        int $applicationId,
        Applicant $applicant,
        array $data
    ): ApplicationA1Course {

        $application = $this->validateEditableApplication(
            $applicationId,
            $applicant
        );

        return ApplicationA1Course::create([

            'application_id'
                => $application->id,

            'course_code'
                => $data['course_code'],

            'course_name'
                => $data['course_name'],

            'credits'
                => $data['credits'],

            'grade'
                => strtoupper(
                    $data['grade']
                ),

            'institution_name'
                => $data['institution_name'],
        ]);
    }

    /**
     * Update A1 course.
     */
    public function update(
        int $applicationId,
        int $courseId,
        Applicant $applicant,
        array $data
    ): ApplicationA1Course {

        $this->validateEditableApplication(
            $applicationId,
            $applicant
        );

        $course = $this->getById(
            $applicationId,
            $courseId,
            $applicant
        );

        $course->update([

            'course_code'
                => $data['course_code'],

            'course_name'
                => $data['course_name'],

            'credits'
                => $data['credits'],

            'grade'
                => strtoupper(
                    $data['grade']
                ),

            'institution_name'
                => $data['institution_name'],
        ]);

        return $course->fresh();
    }

    /**
     * Validate editable application.
     */
    private function validateEditableApplication(
        int $applicationId,
        Applicant $applicant
    ): Application {

        $application = $this->getApplication(
            $applicationId,
            $applicant
        );

        if (
            !in_array(
                $application->status,
                [
                    ApplicationStatus::DRAFT,
                    ApplicationStatus::RETURNED,
                ]
            )
        ) {

            abort(
                422,
                'Application cannot be modified.'
            );
        }

        return $application;
    }

    /**
     * Get applicant application.
     */
    private function getApplication(
        int $applicationId,
        Applicant $applicant
    ): Application {

        $application = Application::query()

            ->where(
                'applicant_id',
                $applicant->id
            )

            ->findOrFail(
                $applicationId
            );

        if (
            !in_array(
                $application->rpl_type,
                [
                    RplType::A1,
                    RplType::HYBRID,
                ],
                true
            )
        ) {

            abort(
                422,
                'A1 courses are only available for A1 or Hybrid applications.'
            );
        }

        return $application;
    }
}
