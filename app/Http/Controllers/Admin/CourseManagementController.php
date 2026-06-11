<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseManagement\StoreCourseRequest;
use App\Http\Requests\Admin\CourseManagement\ToggleCourseStatusRequest;
use App\Http\Requests\Admin\CourseManagement\UpdateCourseRequest;
use App\Services\CourseManagementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseManagementController extends Controller
{
    /**
     * Course management service.
     */
    protected CourseManagementService
        $courseManagementService;

    /**
     * Constructor.
     */
    public function __construct(
        CourseManagementService
        $courseManagementService
    ) {

        $this->courseManagementService =
            $courseManagementService;
    }

    /**
     * Get all courses.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $courses = $this
            ->courseManagementService
            ->list(
                $request->only([
                    'search',
                    'study_program_id',
                    'is_active',
                    'per_page',
                ])
            );

        return response()->json([
            'success' => true,
            'message' =>
                'Courses retrieved successfully.',
            'data' => $courses,
        ]);
    }

    /**
     * Get course detail.
     */
    public function show(
        int $id
    ): JsonResponse {

        $course = $this
            ->courseManagementService
            ->getById($id);

        return response()->json([
            'success' => true,
            'message' =>
                'Course retrieved successfully.',
            'data' => $course,
        ]);
    }

    /**
     * Create course.
     */
    public function store(
        StoreCourseRequest $request
    ): JsonResponse {

        $course = $this
            ->courseManagementService
            ->create(
                $request->validated()
            );

        return response()->json([
            'success' => true,
            'message' =>
                'Course created successfully.',
            'data' => $course,
        ], 201);
    }

    /**
     * Update course.
     */
    public function update(
        UpdateCourseRequest $request,
        int $id
    ): JsonResponse {

        $course = $this
            ->courseManagementService
            ->update(
                $id,
                $request->validated()
            );

        return response()->json([
            'success' => true,
            'message' =>
                'Course updated successfully.',
            'data' => $course,
        ]);
    }

    /**
     * Toggle course status.
     */
    public function toggleStatus(
        ToggleCourseStatusRequest $request,
        int $id
    ): JsonResponse {

        $course = $this
            ->courseManagementService
            ->toggleStatus(
                $id,
                $request->validated()['is_active']
            );

        return response()->json([
            'success' => true,
            'message' =>
                'Course status updated successfully.',
            'data' => $course,
        ]);
    }

    /**
     * Get all active courses (public, any authenticated role).
     */
    public function publicIndex(Request $request): JsonResponse
    {
        $courses = $this
            ->courseManagementService
            ->list([
                'study_program_id' => $request->query('study_program_id'),
                'semester'         => $request->query('semester'),
                'search'           => $request->query('search'),
                'is_active'        => true,
                'per_page'         => 100,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Courses retrieved successfully.',
            'data'    => $courses,
        ]);
    }
}