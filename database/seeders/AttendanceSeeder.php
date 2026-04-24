<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
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
            $randomSubjects = $subjects->random(min(rand(1, 3), $subjects->count()));

            foreach ($randomSubjects as $subject) {
                for ($i = 0; $i < 5; $i++) {
                    Attendance::factory()->create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'date' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    ]);
                }
            }
        }
    }
}
