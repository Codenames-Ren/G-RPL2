<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Applicant\A2\StoreApplicationA2LearningExperienceRequest;
use App\Http\Requests\Applicant\A2\UpdateApplicationA2LearningExperienceRequest;

use App\Services\ApplicationA2LearningExperienceService;

use Illuminate\Http\Request;

class ApplicationA2LearningExperienceController extends Controller
{
    public function __construct(
        protected ApplicationA2LearningExperienceService $applicationA2LearningExperienceService
    ) {}

    /**
     * Get all learning experiences.
     */
    public function index(
        Request $request,
        int $application
    )
    {
        return response()->json([
            'success' => true,

            'data'
                => $this->applicationA2LearningExperienceService->list(
                    $application,
                    $request->user()->applicant
                ),
        ]);
    }

    /**
     * Get learning experience detail.
     */
    public function show(
        Request $request,
        int $application,
        int $experience
    )
    {
        return response()->json([
            'success' => true,

            'data'
                => $this->applicationA2LearningExperienceService->getById(
                    $application,
                    $experience,
                    $request->user()->applicant
                ),
        ]);
    }

    /**
     * Create learning experience.
     */
    public function store(
        StoreApplicationA2LearningExperienceRequest $request,
        int $application
    )
    {
        return response()->json([
            'success' => true,

            'message'
                => 'Learning experience created successfully.',

            'data'
                => $this->applicationA2LearningExperienceService->create(
                    $application,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ], 201);
    }

    /**
     * Update learning experience.
     */
    public function update(
        UpdateApplicationA2LearningExperienceRequest $request,
        int $application,
        int $experience
    )
    {
        return response()->json([
            'success' => true,

            'message'
                => 'Learning experience updated successfully.',

            'data'
                => $this->applicationA2LearningExperienceService->update(
                    $application,
                    $experience,
                    $request->user()->applicant,
                    $request->validated()
                ),
        ]);
    }
}