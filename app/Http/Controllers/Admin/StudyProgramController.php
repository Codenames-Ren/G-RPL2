<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StudyProgram\StoreStudyProgramRequest;

use App\Http\Requests\Admin\StudyProgram\UpdateStudyProgramRequest;

use App\Models\StudyProgram;

use App\Services\StudyProgramService;

class StudyProgramController extends Controller
{
    public function __construct(
        protected StudyProgramService $studyProgramService
    ) {}

    /*
    | Get All Study Programs
    */

    public function index()
    {
        return response()->json([
            'success' => true,

            'data' => $this->studyProgramService
                ->getAll()
        ]);
    }

    /*
    | Get Active Study Programs
    */

    public function publicIndex()
    {
        return response()->json([
            'success' => true,

            'data' => $this->studyProgramService
                ->getActive()
        ]);
    }

    /*
    | Get Detail Study Program
    */

    public function show(
        StudyProgram $studyProgram
    )
    {
        return response()->json([
            'success' => true,

            'data' => $this->studyProgramService
                ->getById($studyProgram)
        ]);
    }

    /*
    | Create Study Program
    */

    public function store(
        StoreStudyProgramRequest $request
    )
    {
        return response()->json(
            $this->studyProgramService
                ->store($request),
            201
        );
    }

    /*
    | Update Study Program
    */

    public function update(
        UpdateStudyProgramRequest $request,
        StudyProgram $studyProgram
    )
    {
        return response()->json(
            $this->studyProgramService
                ->update(
                    $request,
                    $studyProgram
                )
        );
    }
}