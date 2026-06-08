<?php

namespace App\Http\Requests\Assessor\CourseMapping;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssessmentCourseMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'course_id' => [

                'nullable',
                'integer',
                'exists:courses,id',
                'required_if:is_recognized,true',
            ],

            'is_recognized' => [

                'required',
                'boolean',
            ],

            'notes' => [

                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}