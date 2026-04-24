<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Seed basic roles
        DB::table('roles')->insert([
            ['name' => 'Admin', 'slug' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teacher', 'slug' => 'teacher', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Student', 'slug' => 'student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Parent', 'slug' => 'parent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staff', 'slug' => 'staff', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
