<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [

        'application_id',

        'document_type',

        'document_name',

        'file_name',

        'file_path',

        'mime_type',

        'file_size',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function application()
    {
        return $this->belongsTo(
            Application::class
        );
    }
}