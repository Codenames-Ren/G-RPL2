<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\Application;

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
        return Application::query()
            ->where('status', ApplicationStatus::ASSESSED)
            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.courseMappings.course',
            ])
            ->latest()
            ->get();
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
        return Application::query()

            ->where(
                'status',
                ApplicationStatus::APPROVED
            )

            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.courseMappings.course',
            ])

            ->latest()

            ->get();
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
}