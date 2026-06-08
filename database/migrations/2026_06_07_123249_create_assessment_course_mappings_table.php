<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'assessment_course_mappings',
            function (
                Blueprint $table
            ) {

                $table->id();

                /*
                |--------------------------------------------------------------------------
                | Assessment
                |--------------------------------------------------------------------------
                */

                $table->foreignId(
                    'assessment_id'
                )
                    ->constrained()
                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Source Assessment Item
                |--------------------------------------------------------------------------
                */

                $table->foreignId(
                    'application_a1_course_id'
                )
                    ->nullable();

                $table->foreign(
                    'application_a1_course_id',
                    'fk_assessment_a1'
                )
                    ->references('id')
                    ->on(
                        'application_a1_courses'
                    )
                    ->nullOnDelete();

                $table->foreignId(
                    'application_a2_learning_experience_id'
                )
                    ->nullable();

                $table->foreign(
                    'application_a2_learning_experience_id',
                    'fk_assessment_a2'
                )
                    ->references('id')
                    ->on(
                        'application_a2_learning_experiences'
                    )
                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Target Course Global
                |--------------------------------------------------------------------------
                */

                $table->foreignId(
                    'course_id'
                )
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Assessment Result
                |--------------------------------------------------------------------------
                */

                $table->boolean(
                    'is_recognized'
                )
                    ->default(
                        false
                    );

                $table->text(
                    'notes'
                )
                    ->nullable();

                /*
                |--------------------------------------------------------------------------
                | Unique Mapping
                |--------------------------------------------------------------------------
                */

                $table->unique([
                    'assessment_id',
                    'application_a1_course_id',
                    'course_id',
                ], 'assessment_a1_mapping_unique');

                $table->unique([
                    'assessment_id',
                    'application_a2_learning_experience_id',
                    'course_id',
                ], 'assessment_a2_mapping_unique');

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'assessment_course_mappings'
        );
    }
};