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
        Schema::rename('courses', 'subjects');

        Schema::table('enrollments', function (Blueprint $table) {
            $table->renameColumn('course_id', 'subject_id');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->renameColumn('course_id', 'subject_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->renameColumn('subject_id', 'course_id');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->renameColumn('subject_id', 'course_id');
        });

        Schema::rename('subjects', 'courses');
    }
};
