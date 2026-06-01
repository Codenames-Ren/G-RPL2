<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Applicant\Application\StoreApplicationRequest;
use App\Http\Requests\Applicant\Application\UpdateApplicationRequest;

use App\Services\ApplicationService;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(
        protected ApplicationService $applicationService
    ) {}

    /**
     * Get all applications.
     */
    public function index(
        Request $request
    )
    {
        return response()->json([
            'success' => true,

            'data' => $this->applicationService->list(
                $request->user()->applicant,
                $request->all()
            ),
        ]);
    }

    /**
     * Get application detail.
     */
    public function show(
        Request $request,
        int $application
    )
    {
        return response()->json([
            'success' => true,

            'data' => $this->applicationService->getById(
                $application,
                $request->user()->applicant
            ),
        ]);
    }

    /**
     * Create application.
     */
    public function store(
        StoreApplicationRequest $request
    )
    {
        return response()->json([
            'success' => true,

            'message'
                => 'Application created successfully.',

            'data'
                => $this->applicationService->create(
                    $request->user()->applicant,
                    $request->validated()
                ),
        ], 201);
    }

    /**
     * Update application.
     */
    public function update(
        UpdateApplicationRequest $request,
        int $application
    )
    {
        return response()->json([
            'success' => true,

            'message'
                => 'Application updated successfully.',

            'data'
                => $this->applicationService->update(
                    $application,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ]);
    }

    /**
     * Submit application.
     */
    public function submit(
        Request $request,
        int $application
    )
    {
        return response()->json([
            'success' => true,

            'message'
                => 'Application submitted successfully.',

            'data'
                => $this->applicationService->submit(
                    $application,
                    $request->user()->applicant
                ),
        ]);
    }
}