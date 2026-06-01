<?php

namespace App\Http\Requests\Applicant\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationDocumentRequest extends FormRequest
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

            /*
            | Document Information
            */

            'document_type' => [
                'required',
                'string',
                'max:100',
            ],

            'document_name' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            | File
            */

            'file' => [
                'required',
                'file',

                /*
                | PDF
                | JPG
                | JPEG
                | PNG
                */

                'mimes:pdf,jpg,jpeg,png',

                /*
                | 10 MB
                */

                'max:10240',
            ],
        ];
    }
}