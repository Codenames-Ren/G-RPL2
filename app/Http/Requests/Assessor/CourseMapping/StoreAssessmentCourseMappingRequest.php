<?php

namespace App\Http\Requests\Assessor\CourseMapping;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentCourseMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'application_a1_course_id' => [

                'nullable',
                'integer',
                'exists:application_a1_courses,id',
                'required_without:application_a2_learning_experience_id',
            ],

            'application_a2_learning_experience_id' => [

                'nullable',
                'integer',
                'exists:application_a2_learning_experiences,id',
                'required_without:application_a1_course_id',
            ],

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

    public function messages(): array
    {
        return [

            'application_a1_course_id.required_without'
                => 'Either A1 course or A2 learning experience must be selected.',

            'application_a2_learning_experience_id.required_without'
                => 'Either A1 course or A2 learning experience must be selected.',

            'course_id.required_if'
                => 'Target course is required when mapping is recognized.',
        ];
    }
}