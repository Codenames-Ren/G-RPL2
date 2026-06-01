<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'phone',
        'address',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'nationality',
        'postal_code',
        'last_education',
        'institution_name',
        'study_program',
        'graduation_year',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function applications(): HasMany
    {
        return $this->hasMany(
            Application::class
        );
    }
}