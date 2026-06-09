<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assessor\Assessment\StoreAssessmentRequest;
use App\Http\Requests\Assessor\CourseMapping\StoreAssessmentCourseMappingRequest;
use App\Http\Requests\Assessor\CourseMapping\UpdateAssessmentCourseMappingRequest;
use App\Services\AssessorAssessmentService;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function __construct(
        protected AssessorAssessmentService $assessorAssessmentService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Get Assigned Applications
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->assessorAssessmentService
                    ->list(
                        $request->user()->assessor
                    ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Assessment Detail
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
                => $this->assessorAssessmentService
                    ->getById(
                        $application,
                        $request->user()->assessor
                    ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Assessment
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreAssessmentRequest $request,
        int $application
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Assessment created successfully.',

            'data'
                => $this->assessorAssessmentService
                    ->createAssessment(
                        $application,
                        $request->user()->assessor,
                        $request->validated()
                    ),
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Course Mappings
    |--------------------------------------------------------------------------
    */

    public function mappings(
        Request $request,
        int $assessment
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->assessorAssessmentService
                    ->getCourseMappings(
                        $assessment,
                        $request->user()->assessor
                    ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Course Mapping
    |--------------------------------------------------------------------------
    */

    public function storeCourseMapping(
        StoreAssessmentCourseMappingRequest $request,
        int $assessment
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Course mapping created successfully.',

            'data'
                => $this->assessorAssessmentService
                    ->storeCourseMapping(
                        $assessment,
                        $request->user()->assessor,
                        $request->validated()
                    ),
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Course Mapping
    |--------------------------------------------------------------------------
    */

    public function updateCourseMapping(
        UpdateAssessmentCourseMappingRequest $request,
        int $mapping
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Course mapping updated successfully.',

            'data'
                => $this->assessorAssessmentService
                    ->updateCourseMapping(
                        $mapping,
                        $request->user()->assessor,
                        $request->validated()
                    ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Submit Assessment
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        int $assessment
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Assessment submitted successfully.',

            'data'
                => $this->assessorAssessmentService
                    ->submitAssessment(
                        $assessment,
                        $request->user()->assessor
                    ),
        ]);
    }
}