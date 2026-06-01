<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Applicant\Document\StoreApplicationDocumentRequest;
use App\Http\Requests\Applicant\Document\UpdateApplicationDocumentRequest;

use App\Services\ApplicationDocumentService;

use Illuminate\Http\Request;

class ApplicationDocumentController extends Controller
{
    public function __construct(
        protected ApplicationDocumentService $applicationDocumentService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Get All Documents
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->applicationDocumentService->index(
                    $application,
                    $request->user()->applicant
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Document Detail
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        int $application,
        int $document
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->applicationDocumentService->show(
                    $application,
                    $document,
                    $request->user()->applicant
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Document
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreApplicationDocumentRequest $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Document uploaded successfully.',

            'data'
                => $this->applicationDocumentService->store(
                    $application,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Document
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateApplicationDocumentRequest $request,
        int $application,
        int $document
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Document updated successfully.',

            'data'
                => $this->applicationDocumentService->update(
                    $application,
                    $document,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Download Document
    |--------------------------------------------------------------------------
    */

    public function download(
        Request $request,
        int $application,
        int $document
    )
    {
        return $this->applicationDocumentService->download(
            $application,
            $document,
            $request->user()->applicant
        );
    }
}