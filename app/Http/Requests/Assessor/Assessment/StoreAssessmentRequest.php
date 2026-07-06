<?php

namespace App\Http\Requests\Assessor\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'notes' => [ 'nullable', 'string', ],
        ];
    }
}