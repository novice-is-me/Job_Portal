<?php

namespace Database\Seeders;

use App\Models\ExperienceLevel;
use App\Models\User;
use App\Models\UserType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user_type = [
            'user',
            'admin',
            'recruiter',
        ];

        foreach($user_type as $type){
            UserType::create([
                'name' => $type,
            ]);
        }

        $this->call([
            CategorySeeder::class,
            UserTypeSeeder::class,
            RecruiterSeeder::class,
            ExprienceLevelSeeder::class,
            CompanySeeder::class,
            JobSeeder::class,
            SkillSeeder::class
        ]);
    }
}
