<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'application_a1_courses',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId('application_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->string('course_code');

                $table->string('course_name');

                $table->unsignedTinyInteger('credits');

                $table->string('grade', 5);

                $table->string('institution_name');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_a1_courses');
    }
};
