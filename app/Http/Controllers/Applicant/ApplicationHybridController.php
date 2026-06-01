<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Applicant\Hybrid\StoreHybridApplicationRequest;
use App\Http\Requests\Applicant\Hybrid\UpdateHybridApplicationRequest;

use App\Services\ApplicationHybridService;

use Illuminate\Http\Request;

class ApplicationHybridController extends Controller
{
    public function __construct(
        protected ApplicationHybridService $applicationHybridService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Get All Hybrid Applications
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->applicationHybridService->index(
                    $request->user()->applicant
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Hybrid Detail
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->applicationHybridService->show(
                    $application,
                    $request->user()->applicant
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Hybrid Application
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreHybridApplicationRequest $request
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Hybrid application created successfully.',

            'data'
                => $this->applicationHybridService->store(
                    $request->user()->applicant,
                    $request->validated()
                ),
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Hybrid Application
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateHybridApplicationRequest $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Hybrid application updated successfully.',

            'data'
                => $this->applicationHybridService->update(
                    $application,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ]);
    }
}