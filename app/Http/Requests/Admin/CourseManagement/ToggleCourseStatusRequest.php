<?php

namespace App\Http\Requests\Admin\CourseManagement;

use Illuminate\Foundation\Http\FormRequest;

class ToggleCourseStatusRequest extends FormRequest
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

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}