<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [

        'application_number',

        'applicant_id',

        'assigned_assessor_id',

        'study_program_id',

        'rpl_type',

        'status',

        'review_notes',

        'revision_count',

        'submitted_at',
    ];

    protected function casts(): array
    {
        return [

            'revision_count'
                => 'integer',

            'submitted_at'
                => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function applicant()
    {
        return $this->belongsTo(
            Applicant::class
        );
    }

    public function studyProgram()
    {
        return $this->belongsTo(
            StudyProgram::class
        );
    }

    public function a1Courses()
    {
        return $this->hasMany(
            ApplicationA1Course::class
        );
    }

    public function a2LearningExperiences()
    {
        return $this->hasMany(
            ApplicationA2LearningExperience::class
        );
    }

    public function documents()
    {
        return $this->hasMany(
            ApplicationDocument::class
        );
    }

    /*
    | Assigned Assessor
    */

    public function assignedAssessor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'assigned_assessor_id'
        );
    }
}