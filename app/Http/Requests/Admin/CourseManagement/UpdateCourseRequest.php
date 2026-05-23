<?php

namespace App\Http\Requests\Admin\CourseManagement;

use App\Enums\CourseRplType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [

            'study_program_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'study_program_ids.*' => [
                'exists:study_programs,id',
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique(
                    'courses',
                    'code'
                )->ignore(
                    $this->route('course')
                ),
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'semester' => [
                'required',
                'integer',
                'min:1',
                'max:14',
            ],

            'sks' => [
                'required',
                'integer',
                'min:1',
                'max:4',
            ],

            'rpl_type' => [
                'required',
                Rule::in(
                    CourseRplType::ALL
                ),
            ],
        ];
    }
}