<?php

namespace App\Http\Requests\Staff\Submission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignAssessorRequest extends FormRequest
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

            'assessor_id' => [

                'required',

                'integer',

                Rule::exists(
                    'users',
                    'id'
                ),
            ],
        ];
    }
}