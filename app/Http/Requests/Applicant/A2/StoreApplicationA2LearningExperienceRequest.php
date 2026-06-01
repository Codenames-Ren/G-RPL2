<?php

namespace App\Http\Requests\Applicant\A2;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationA2LearningExperienceRequest extends FormRequest
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

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'experience_type' => [
                'required',
                'string',
                'max:100',
            ],

            'organization_name' => [
                'required',
                'string',
                'max:255',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'is_ongoing' => [
                'required',
                'boolean',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],
        ];
    }

    /**
     * Custom messages.
     */
    public function messages(): array
    {
        return [

            'title.required'
                => 'Title is required.',

            'experience_type.required'
                => 'Experience type is required.',

            'organization_name.required'
                => 'Organization name is required.',

            'end_date.after_or_equal'
                => 'End date must be after start date.',

            'description.required'
                => 'Description is required.',
        ];
    }
}