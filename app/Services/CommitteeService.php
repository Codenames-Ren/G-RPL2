<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public function generateApprovedRecapPdf(
        string $year = null,
        string $monthFrom = null,
        string $monthTo = null,
        string $search = null
    ) {
        $query = Application::query()
            ->where('status', ApplicationStatus::APPROVED)
            ->with([
                'applicant.user',
                'studyProgram.faculty',
                'assessment.courseMappings.course',
                'assessment.courseMappings.applicationA1Course',
                'assessment.courseMappings.applicationA2LearningExperience',
            ]);

        // Filter: Bisa hanya Tahun, bisa Tahun + range Bulan (termasuk yang wrap ke tahun berikutnya, misal Des-Feb)
        if ($year) {
            [$startDate, $endDate] = $this->resolvePeriodRange($year, $monthFrom, $monthTo);

            if ($startDate && $endDate) {
                $query->whereBetween('updated_at', [$startDate, $endDate]);
            } else {
                $query->whereYear('updated_at', $year);
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

        // Pecah SKS jadi Transfer (A1) & Perolehan (A2)
        $applications->each(function ($app) {
            $transferSks = 0;
            $perolehanSks = 0;

            if ($app->assessment) {
                foreach ($app->assessment->courseMappings as $mapping) {
                    if (!$mapping->is_recognized) {
                        continue;
                    }

                    $sks = $mapping->course->sks ?? 0;

                    if ($mapping->applicationA1Course) {
                        $transferSks += $sks;
                    } elseif ($mapping->applicationA2LearningExperience) {
                        $perolehanSks += $sks;
                    }
                }
            }

            $app->transfer_sks = $transferSks;
            $app->perolehan_sks = $perolehanSks;
            $app->total_sks = $transferSks + $perolehanSks;
        });

        return Pdf::loadView('pdf.committee.approved-recap', [
            'applications' => $applications,
            'year' => $year,
            'monthFrom' => $monthFrom,
            'monthTo' => $monthTo,
            'search' => $search
        ])->setPaper('A4', 'portrait');
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve Period Range (support bulan yang wrap ke tahun berikutnya)
    |--------------------------------------------------------------------------
    */

    private function resolvePeriodRange(string $year, ?string $monthFrom, ?string $monthTo): array
    {
        // Kalau ga ada bulan yang dipilih sama sekali, filter berdasarkan tahun aja
        if (!$monthFrom && !$monthTo) {
            return [null, null];
        }

        $fromMonth = (int) ($monthFrom ?: 1);
        $toMonth = (int) ($monthTo ?: $monthFrom);

        $startYear = (int) $year;
        $endYear = $startYear;

        // Contoh: Desember (12) -> Februari (2) berarti bulan akhir masuk ke tahun berikutnya
        if ($toMonth < $fromMonth) {
            $endYear++;
        }

        $startDate = Carbon::create($startYear, $fromMonth, 1)->startOfMonth();
        $endDate = Carbon::create($endYear, $toMonth, 1)->endOfMonth();

        return [$startDate, $endDate];
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Approved Recap Detail PDF (per Mata Kuliah)
    |--------------------------------------------------------------------------
    */

    public function generateApprovedRecapDetailPdf(
        string $year = null,
        string $monthFrom = null,
        string $monthTo = null,
        string $search = null
    ) {
        $query = Application::query()
            ->where('status', ApplicationStatus::APPROVED)
            ->with([
                'applicant.user',
                'studyProgram',
                'assessment.courseMappings.course',
                'assessment.courseMappings.applicationA1Course',
                'assessment.courseMappings.applicationA2LearningExperience',
            ]);

        if ($year) {
            [$startDate, $endDate] = $this->resolvePeriodRange($year, $monthFrom, $monthTo);

            if ($startDate && $endDate) {
                $query->whereBetween('updated_at', [$startDate, $endDate]);
            } else {
                $query->whereYear('updated_at', $year);
            }
        }

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

        // Flatten: satu baris per mata kuliah hasil mapping yang recognized
        $rows = collect();

        foreach ($applications as $app) {
            if (!$app->assessment) {
                continue;
            }

            foreach ($app->assessment->courseMappings as $mapping) {
                // Cuma matkul yang udah di-assessment & diakui (recognized) yang tampil
                if (!$mapping->is_recognized || !$mapping->course) {
                    continue;
                }

                $rows->push([
                    'student_name'  => $app->applicant->user->name ?? '-',
                    'course_code'   => $mapping->course->code ?? '-',
                    'course_name'   => $mapping->course->name ?? '-',
                    'sks'           => $mapping->course->sks ?? 0,
                    'grade'         => $mapping->grade ?? '-',
                    'is_transfer'   => (bool) $mapping->application_a1_course_id,
                    'is_perolehan'  => (bool) $mapping->application_a2_learning_experience_id,
                ]);
            }
        }

        $rows = $rows
            ->sortBy(fn ($row) => $row['student_name'] . $row['course_code'])
            ->values();

        return Pdf::loadView('pdf.committee.recap-detail', [
            'rows'      => $rows,
            'year'      => $year,
            'monthFrom' => $monthFrom,
            'monthTo'   => $monthTo,
            'search'    => $search,
        ])->setPaper('A4', 'portrait');
    }
}