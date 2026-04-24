<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();

        if ($teachers->isEmpty()) {
            $teachers = Teacher::factory(10)->create();
        }

        foreach ($teachers as $teacher) {
            SchoolClass::factory()->create([
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}
