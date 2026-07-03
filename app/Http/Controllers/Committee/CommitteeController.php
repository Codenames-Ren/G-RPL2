<?php

namespace App\Http\Controllers\Committee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Committee\Approval\ApproveApplicationRequest;
use App\Services\CommitteeService;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Enums\ApplicationStatus;

class CommitteeController extends Controller
{
    public function __construct(
        protected CommitteeService $committeeService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Get Assessed Applications
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->committeeService
                    ->listAssessedApplications(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Application Detail
    |--------------------------------------------------------------------------
    */

    public function show(
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->committeeService
                    ->getById(
                        $application
                    ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Preview Rector Decree
    |--------------------------------------------------------------------------
    */

    public function previewRectorDecree(
        int $application
    )
    {
        return $this->committeeService
            ->previewRectorDecree(
                $application
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Download Rector Decree
    |--------------------------------------------------------------------------
    */

    public function downloadRectorDecree(
        int $application
    )
    {
        return $this->committeeService
            ->downloadRectorDecree(
                $application
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Preview Assessment Summary
    |--------------------------------------------------------------------------
    */

    public function previewAssessmentSummary(
        int $application
    )
    {
        return $this->committeeService
            ->previewAssessmentSummary(
                $application
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Download Assessment Summary
    |--------------------------------------------------------------------------
    */

    public function downloadAssessmentSummary(
        int $application
    )
    {
        return $this->committeeService
            ->downloadAssessmentSummary(
                $application
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Approve Application
    |--------------------------------------------------------------------------
    */

    public function approve(
        ApproveApplicationRequest $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Application approved successfully.',

            'data'
                => $this->committeeService
                    ->approveApplication(
                        $application,
                        $request->validated()
                    ),
        ]);
    }

    public function approved()
    {
        return response()->json([

            'success' => true,

            'data' =>
                $this->committeeService
                    ->listApprovedApplications(),
        ]);
    }

    public function showApproved(Application $application)
    {
        if ($application->status !== ApplicationStatus::APPROVED) {
            abort(422, 'Application is not approved.');
        }

        return response()->json([
            'success' => true,
            'data' => $this->committeeService->getApprovedApplicationDetail($application)
        ]);
    }

    public function downloadDocument(int $application, int $document)
    {
        return $this->committeeService->downloadDocument($application, $document);
    }

    /*
    |--------------------------------------------------------------------------
    | Cetak PDF Rekapitulasi Disetujui (Baru)
    |--------------------------------------------------------------------------
    */

    public function printApprovedRecap(Request $request)
    {
        $period = $request->query('period');
        $search = $request->query('search');

        $pdf = $this->committeeService->generateApprovedRecapPdf($period, $search);

        $filename = 'Rekap-Pendaftaran-Disetujui';
        if ($period) {
            $filename .= '-' . $period;
        }
        $filename .= '.pdf';

        // Pakai stream supaya kebuka di tab baru (kayak fungsi preview)
        return $pdf->stream($filename);
    }
}