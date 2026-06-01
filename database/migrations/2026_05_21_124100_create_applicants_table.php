<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (
            Blueprint $table
        ) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            | Basic Information
            */

            $table->string('nik')
                ->unique();

            $table->string('phone')
                ->nullable();

            $table->text('address')
                ->nullable();

            /*
            | Personal Information
            */

            $table->string('birth_place')
                ->nullable();

            $table->date('birth_date')
                ->nullable();

            $table->enum('gender', [
                'male',
                'female',
            ])->nullable();

            $table->enum('marital_status', [
                'single',
                'married',
                'divorced',
            ])->nullable();

            $table->string('nationality')
                ->default('Indonesia');

            $table->string('postal_code')
                ->nullable();

            /*
            | Education Information
            */

            $table->string('last_education')
                ->nullable();

            $table->string('institution_name')
                ->nullable();

            $table->string('study_program')
                ->nullable();

            $table->year('graduation_year')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'applicants'
        );
    }
};