<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherRole = Role::where('slug', 'teacher')->first();
        $teachers = User::where('role_id', $teacherRole->id)->get();

        if ($teachers->isEmpty()) {
            return;
        }

        foreach ($teachers as $teacher) {
            Subject::factory(3)->create([
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}
