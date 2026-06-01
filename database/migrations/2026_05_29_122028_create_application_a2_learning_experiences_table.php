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
            'application_a2_learning_experiences',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId('application_id')
                    ->constrained()
                    ->cascadeOnDelete();

                /*
                | Experience Information
                */

                $table->string('title');

                $table->string('experience_type');

                $table->string('organization_name');

                $table->date('start_date')
                    ->nullable();

                $table->date('end_date')
                    ->nullable();

                $table->boolean('is_ongoing')
                    ->default(false);

                $table->longText('description');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'application_a2_learning_experiences'
        );
    }
};