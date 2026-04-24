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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->string('employee_no')->unique();
            $table->string('department')->nullable();
            $table->timestamps();
        });

        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('grade')->nullable();
            $table->string('admission_no')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
        });

        Schema::create('parent_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('occupation')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('position')->nullable();
            $table->string('access_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_profiles');
        Schema::dropIfExists('parent_profiles');
        Schema::dropIfExists('student_profiles');
        Schema::dropIfExists('teacher_profiles');
    }
};
