<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseManagementService
{
    /**
     * Get all courses.
     */
    public function list(
    array $filters = []
    ): LengthAwarePaginator {

        return Course::query()

            ->with([
                'studyPrograms',
            ])

            ->when(
                $filters['search'] ?? null,
                function ($query, $search) {

                    $query->where(function ($q)
                    use ($search) {

                        $q->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )->orWhere(
                            'code',
                            'like',
                            "%{$search}%"
                        );
                    });
                }
            )

            ->when(
                $filters['study_program_id'] ?? null,
                function ($query, $studyProgramId) {

                    $query->whereHas(
                        'studyPrograms',
                        function ($q) use ($studyProgramId) {

                            $q->where(
                                'study_program_id',
                                $studyProgramId
                            );
                        }
                    );
                }
            )

            ->when(
                $filters['semester'] ?? null,
                function ($query, $semester) {
                    $query->where('semester', $semester);
                }
            )

            ->when(
                isset($filters['is_active']),
                function ($query) use ($filters) {

                    $query->where(
                        'is_active',
                        $filters['is_active']
                    );
                }
            )

            ->latest()

            ->paginate(
                $filters['per_page'] ?? 10
            );
    }

    /**
     * Get course detail.
     */
    public function getById(
        int $id
    ): Course {

        return Course::with([
            'studyPrograms',
        ])->findOrFail($id);
    }

    /**
     * Create course.
     */
    public function create(
        array $data
    ): Course {

        $course = Course::create([

            'code'
                => strtoupper(
                    $data['code']
                ),

            'name'
                => $data['name'],

            'semester'
                => $data['semester'],

            'sks'
                => $data['sks'],

            'rpl_type'
                => $data['rpl_type'],

            'status'
                => 'active',

            'is_active'
                => true,
        ]);

        $course->studyPrograms()->sync(
            $data['study_program_ids']
        );

        return $this->getById(
            $course->id
        );
    }

    /**
     * Update course.
     */
    public function update(
        int $id,
        array $data
    ): Course {

        $course = Course::findOrFail($id);

        $course->update([

            'code'
                => strtoupper(
                    $data['code']
                ),

            'name'
                => $data['name'],

            'semester'
                => $data['semester'],

            'sks'
                => $data['sks'],

            'rpl_type'
                => $data['rpl_type'],
        ]);

        $course->studyPrograms()->sync(
            $data['study_program_ids']
        );

        return $this->getById(
            $course->id
        );
    }

    /**
     * Toggle course status.
     */
    public function toggleStatus(
        int $id,
        bool $isActive
    ): Course {

        $course = Course::findOrFail($id);

        $course->update([

            'is_active'
                => $isActive,

            'status'
                => $isActive
                    ? 'active'
                    : 'inactive',
        ]);

        $course->refresh();

        return $this->getById(
            $course->id
        );
    }

    /**
     * Get all active courses.
     */
    public function listActive(): \Illuminate\Database\Eloquent\Collection
    {
        return Course::where('is_active', true)
            ->orderBy('name')
            ->get();
    }
}