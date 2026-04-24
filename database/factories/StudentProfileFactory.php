<?php

namespace Database\Factories;

use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudentProfile>
 */
class StudentProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'grade' => fake()->word(),
            'admission_no' => 'ADM'.fake()->unique()->numberBetween(10000, 99999),
            'parent_id' => null,
            'date_of_birth' => fake()->date(),
        ];
    }
}
