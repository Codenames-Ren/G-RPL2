<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /*
    | Get All Faculties (untuk dropdown pilihan di form Study Program)
    */

    public function index()
    {
        return response()->json([
            'success' => true,

            'data' => Faculty::orderBy('name')->get(['id', 'code', 'name']),
        ]);
    }

    /*
    | Get Detail Faculty
    */

    public function show(
        Faculty $faculty
    )
    {
        return response()->json([
            'success' => true,

            'data' => $faculty,
        ]);
    }

    /*
    | Create Faculty
    */

    public function store(
        Request $request
    )
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:faculties,code',

            'name' => 'required|string|max:255|unique:faculties,name',
        ]);

        $faculty = Faculty::create($validated);

        return response()->json([
            'success' => true,

            'message' => 'Faculty created successfully',

            'data' => $faculty,
        ], 201);
    }

    /*
    | Update Faculty
    */

    public function update(
        Request $request,
        Faculty $faculty
    )
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:faculties,code,' . $faculty->id,

            'name' => 'required|string|max:255|unique:faculties,name,' . $faculty->id,
        ]);

        $faculty->update($validated);

        return response()->json([
            'success' => true,

            'message' => 'Faculty updated successfully',

            'data' => $faculty->fresh(),
        ]);
    }
}