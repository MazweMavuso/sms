<?php

namespace Database\Seeders;

use App\Models\AdminProfile;
use App\Models\ParentProfile;
use App\Models\Role;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $teacherRole = Role::where('slug', 'teacher')->first();
        $studentRole = Role::where('slug', 'student')->first();
        $parentRole = Role::where('slug', 'parent')->first();

        // Admin
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
        ]);
        AdminProfile::factory()->create(['user_id' => $admin->id]);

        // Teachers
        User::factory(5)->create([
            'role_id' => $teacherRole->id,
        ])->each(function ($user) {
            TeacherProfile::factory()->create(['user_id' => $user->id]);
        });

        // Parents
        $parents = User::factory(10)->create([
            'role_id' => $parentRole->id,
        ])->each(function ($user) {
            ParentProfile::factory()->create(['user_id' => $user->id]);
        });

        // Students
        User::factory(20)->create([
            'role_id' => $studentRole->id,
        ])->each(function ($user) use ($parents) {
            StudentProfile::factory()->create([
                'user_id' => $user->id,
                'parent_id' => $parents->random()->id,
            ]);
        });

        // Other users
        User::factory(10)->create();
    }
}
