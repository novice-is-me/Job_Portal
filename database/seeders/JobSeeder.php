<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobRequirement;
use App\Models\JobResponsibility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Job::factory()->count(10)->create();

        // Job Requirement Seeder
        for ($i = 0; $i < 10; $i++) {
            JobRequirement::create([
                'job_id' => rand(1, 10),
                'name' => 'Requirement ' . $i,
                'description' => 'Description of requirement ' . $i,
            ]);
        }

        // Job Responsibility Seeder
        for ($i = 0; $i < 10; $i++) {
            JobResponsibility::create([
                'job_id' => rand(1, 10),
                'name' => 'Responsibility ' . $i,
                'description' => 'Description of responsibility ' . $i,
            ]);
        }
    }
}
