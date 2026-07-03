<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

class CommitteeService
{
    /*
    |--------------------------------------------------------------------------
    | List Assessed Applications
    |--------------------------------------------------------------------------
    */

    public function listAssessedApplications()
    {
        $applications = Application::query()
            ->where('status', ApplicationStatus::ASSESSED)
            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.assessor.user',
                'assessment.courseMappings.course',
            ])
            ->latest()
            ->get();

        $applications->each(function ($app) {
            if ($app->assessment) {
                $app->assessment->total_converted_sks = $app->assessment->courseMappings
                    ->where('is_recognized', true)
                    ->sum(fn($m) => $m->course->sks ?? 0);
            }
        });

        return $applications;
    }

    /*
    |--------------------------------------------------------------------------
    | Application Detail
    |--------------------------------------------------------------------------
    */

    public function getById(
        int $applicationId
    ): Application {

        $application = Application::query()

            ->whereIn('status', [
                ApplicationStatus::ASSESSED,
                ApplicationStatus::APPROVED,
            ])

            ->with([

                'applicant.user',

                'studyProgram',

                'documents',

                'assessment.assessor.user',

                'assessment.courseMappings.applicationA1Course',

                'assessment.courseMappings.applicationA2LearningExperience',

                'assessment.courseMappings.course',
            ])

            ->findOrFail(
                $applicationId
            );

        if ($application->assessment) {

            $totalSKS =
                $application
                    ->assessment
                    ->courseMappings

                    ->where(
                        'is_recognized',
                        true
                    )

                    ->sum(
                        fn ($mapping)
                            => $mapping->course->sks ?? 0
                    );

            $application
                ->assessment
                ->total_converted_sks =
                    $totalSKS;
        }

        return $application;
    }

    /*
    |--------------------------------------------------------------------------
    | Approve Application
    |--------------------------------------------------------------------------
    */

    public function approveApplication(
        int $applicationId,
        array $data
    ): Application {

        $application = Application::query()
            ->whereIn('status', [
                ApplicationStatus::ASSESSED,
                ApplicationStatus::APPROVED,
            ])
            ->findOrFail($applicationId);

        if ($application->status === ApplicationStatus::APPROVED) {
            abort(422, 'Application has already been approved.');
        }

        $application->update([
            'status' => ApplicationStatus::APPROVED,
            'review_notes' => $data['notes'] ?? null,
        ]);

        return $application->fresh();
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Rector Decree PDF
    |--------------------------------------------------------------------------
    */

    public function generateRectorDecreePdf(
        Application $application
    ) {

        return Pdf::loadView(
            'pdf.committee.rector-decree',
            [
                'student'    => $application->applicant->user,
                'application'=> $application,
                'assessment' => $application->assessment,
                'mappings'   => $application->assessment->courseMappings,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Assessment Summary PDF
    |--------------------------------------------------------------------------
    */

    public function generateAssessmentSummaryPdf(
        Application $application
    ) {

        return Pdf::loadView(
            'pdf.committee.assessment-summary',
            [
                'student'    => $application->applicant->user,
                'application'=> $application,
                'assessment' => $application->assessment,
                'mappings'   => $application->assessment->courseMappings,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Preview Rector Decree
    |--------------------------------------------------------------------------
    */

    public function previewRectorDecree(
        int $applicationId
    ) {

        $application = $this->getById(
            $applicationId
        );

        return $this
            ->generateRectorDecreePdf(
                $application
            )
            ->stream(
                'sk-rektor.pdf'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Download Rector Decree
    |--------------------------------------------------------------------------
    */

    public function downloadRectorDecree(
        int $applicationId
    ) {

        $application = $this->getById(
            $applicationId
        );

        return $this
            ->generateRectorDecreePdf(
                $application
            )
            ->download(
                'SK-Rektor-' .
                $application->application_number .
                '.pdf'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Preview Assessment Summary
    |--------------------------------------------------------------------------
    */

    public function previewAssessmentSummary(
        int $applicationId
    ) {

        $application = $this->getById(
            $applicationId
        );

        return $this
            ->generateAssessmentSummaryPdf(
                $application
            )
            ->stream(
                'assessment-summary.pdf'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Download Assessment Summary
    |--------------------------------------------------------------------------
    */

    public function downloadAssessmentSummary(
        int $applicationId
    ) {

        $application = $this->getById(
            $applicationId
        );

        return $this
            ->generateAssessmentSummaryPdf(
                $application
            )
            ->download(
                'Assessment-Summary-' .
                $application->application_number .
                '.pdf'
            );
    }

    public function listApprovedApplications()
    {
        $applications = Application::query()
            ->where('status', ApplicationStatus::APPROVED)
            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.courseMappings.course',
            ])
            ->latest()
            ->get();

        $applications->each(function ($app) {
            if ($app->assessment) {
                $app->assessment->total_converted_sks = $app->assessment->courseMappings
                    ->where('is_recognized', true)
                    ->sum(fn($m) => $m->course->sks ?? 0);
            }
        });

        return $applications;
    }

    public function getApprovedApplicationDetail(Application $application)
    {
        if ($application->status !== ApplicationStatus::APPROVED) {
            abort(422, 'Application is not approved.');
        }

        return $application->load([
            'applicant.user',
            'studyProgram',
            'documents',
            'assessment.courseMappings.course',
            'assessment.courseMappings.applicationA1Course',
            'assessment.courseMappings.applicationA2LearningExperience',
        ]);
    }

    public function downloadDocument(int $applicationId, int $documentId)
    {
        $application = $this->getById($applicationId); // reuse yang udah ada

        $document = $application->documents()->findOrFail($documentId);

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Document file not found.');
        }

        return Storage::disk('public')->download(
            $document->file_path,
            $document->file_name
        );
    }

    public function generateApprovedRecapPdf(string $period = null, string $search = null)
    {
        $query = Application::query()
            ->where('status', ApplicationStatus::APPROVED)
            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.courseMappings.course',
            ]);

        // Filter: Bisa hanya Tahun, bisa Tahun-Bulan
        if ($period) {
            $parts = explode('-', $period);
            $query->whereYear('updated_at', $parts[0]);
            
            // Jika ada bulan yang dipassing (format YYYY-MM)
            if (isset($parts[1]) && $parts[1] !== '') {
                $query->whereMonth('updated_at', $parts[1]);
            }
        }

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('application_number', 'like', "%{$search}%")
                  ->orWhereHas('applicant.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('studyProgram', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $applications = $query->latest('updated_at')->get();

        // Hitung manual total SKS
        $applications->each(function ($app) {
            if ($app->assessment) {
                $app->total_sks = $app->assessment->courseMappings
                    ->where('is_recognized', true)
                    ->sum(fn($m) => $m->course->sks ?? 0);
            } else {
                $app->total_sks = 0;
            }
        });

        return Pdf::loadView('pdf.committee.approved-recap', [
            'applications' => $applications,
            'period' => $period,
            'search' => $search
        ])->setPaper('A4', 'landscape');
    }
}