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
            'application_documents',
            function (Blueprint $table) {

                $table->id();

                /*
                | Application
                */

                $table->foreignId('application_id')
                    ->constrained()
                    ->cascadeOnDelete();

                /*
                | Document Information
                */

                $table->string('document_type');

                $table->string('document_name');

                /*
                | File
                */

                $table->string('file_name');

                $table->string('file_path');

                $table->string('mime_type')
                    ->nullable();

                $table->unsignedBigInteger('file_size')
                    ->nullable();

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
            'application_documents'
        );
    }
};