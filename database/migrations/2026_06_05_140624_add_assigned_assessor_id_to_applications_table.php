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
        Schema::table(
            'applications',
            function (
                Blueprint $table
            ) {

                $table->foreignId(
                    'assigned_assessor_id'
                )
                    ->nullable()
                    ->after(
                        'applicant_id'
                    )
                    ->constrained(
                        'users'
                    )
                    ->nullOnDelete();
            }
        );
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::table(
            'applications',
            function (
                Blueprint $table
            ) {

                $table->dropForeign([
                    'assigned_assessor_id'
                ]);

                $table->dropColumn(
                    'assigned_assessor_id'
                );
            }
        );
    }
};