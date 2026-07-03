<?php

namespace App\Models;

use App\Enums\CourseGrade; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentCourseMapping extends Model
{
    use HasFactory;

    protected $fillable = [

        'assessment_id',
        'application_a1_course_id',
        'application_a2_learning_experience_id',
        'course_id',
        'is_recognized',
        'grade',
        'notes',
    ];

    protected function casts(): array
    {
        return [

            'is_recognized' => 'boolean',
            'grade' => CourseGrade::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(
            Assessment::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Source Application A1 Course
    |--------------------------------------------------------------------------
    */

    public function applicationA1Course(): BelongsTo
    {
        return $this->belongsTo(
            ApplicationA1Course::class,
            'application_a1_course_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Source Application A2 Learning Experience
    |--------------------------------------------------------------------------
    */

    public function applicationA2LearningExperience(): BelongsTo
    {
        return $this->belongsTo(
            ApplicationA2LearningExperience::class,
            'application_a2_learning_experience_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Target Course (Global)
    |--------------------------------------------------------------------------
    */

    public function course(): BelongsTo
    {
        return $this->belongsTo(
            Course::class
        );
    }
}