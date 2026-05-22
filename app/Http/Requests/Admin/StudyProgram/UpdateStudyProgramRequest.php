<?php

namespace App\Http\Requests\Admin\StudyProgram;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            /*
            | Basic Information
            */

            'code' => [
                'required',
                'string',
                'max:20',
                'unique:study_programs,code,' . $this->studyProgram->id,
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            | Academic Information
            */

            'total_sks' => [
                'required',
                'integer',
                'min:1',
            ],

            'max_convertible_sks' => [
                'required',
                'integer',
                'min:1',
                'lte:total_sks',
            ],

            /*
            | RPL Scheme Support
            */

            'supports_a1' => [
                'required',
                'boolean',
            ],

            'supports_a2' => [
                'required',
                'boolean',
            ],

            'is_hybrid_allowed' => [
                'required',
                'boolean',
            ],

            /*
            | Status
            */

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ];
    }
}