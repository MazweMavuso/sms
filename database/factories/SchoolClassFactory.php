<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::factory(),
            'class_number' => $this->faker->numberBetween(1, 12),
            'letter' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
