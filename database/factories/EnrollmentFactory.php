<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => User::factory(),
            'subject_id' => Subject::factory(),
            'enrolled_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
