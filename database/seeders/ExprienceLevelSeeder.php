<?php

namespace Database\Seeders;

use App\Models\ExperienceLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExprienceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $experiences_level = [
            'Entry Level',
            'Mid Level',
            'Senior Level',
            'Associate',
            'Internship',
            'Executive',
        ];

        foreach($experiences_level as $experience){
            ExperienceLevel::create([
                'name' => $experience,
            ]);
        }
    }
}
