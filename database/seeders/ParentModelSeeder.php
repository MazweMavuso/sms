<?php

namespace Database\Seeders;

use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ParentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return;
        }

        ParentModel::factory(30)->create()->each(function ($parent) use ($students) {
            // Assign 1-2 random students to each parent
            $parent->students()->attach(
                $students->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
