<?php

namespace App\Http\Requests\Committee\Approval;

use Illuminate\Foundation\Http\FormRequest;

class ApproveApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'notes' => ['nullable', 'string', 'max:1000'],

        ];
    }
}