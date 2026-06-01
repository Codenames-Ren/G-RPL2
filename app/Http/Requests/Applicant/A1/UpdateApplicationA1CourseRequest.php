<?php

namespace App\Http\Requests\Applicant\A1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationA1CourseRequest extends FormRequest
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

            'course_code' => [
                'required',
                'string',
                'max:50',
            ],

            'course_name' => [
                'required',
                'string',
                'max:255',
            ],

            'credits' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],

            'grade' => [
                'required',
                'string',
                'max:5',
            ],

            'institution_name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}