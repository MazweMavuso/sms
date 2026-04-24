<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentRole = Role::where('slug', 'student')->first();
        $students = User::where('role_id', $studentRole->id)->get();
        $subjects = Subject::all();

        if ($students->isEmpty() || $subjects->isEmpty()) {
            return;
        }

        foreach ($students as $student) {
            $randomSubjects = $subjects->random(min(rand(2, 4), $subjects->count()));

            foreach ($randomSubjects as $subject) {
                Enrollment::factory()->create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
