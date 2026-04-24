<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacherRole = Role::where('slug', 'teacher')->first();

        return [
            'teacher_id' => User::where('role_id', $teacherRole->id)->first()->id ?? User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'credits' => $this->faker->numberBetween(1, 5),
        ];
    }
}
