<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('students');
        // Removed dropping of 'teachers' table to preserve foreign key references.
        // Schema::dropIfExists('teachers');
        Schema::dropIfExists('parents');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-creating these with original structures is complex,
        // usually rolling back this far involves migrate:fresh
    }
};
