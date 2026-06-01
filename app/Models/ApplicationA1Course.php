<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationA1Course extends Model
{
    use HasFactory;

    protected $fillable = [

        'application_id',

        'course_code',

        'course_name',

        'credits',

        'grade',

        'institution_name',
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