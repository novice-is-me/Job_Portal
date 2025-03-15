<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For recuiter only
        \App\Models\User::factory(\Database\Factories\RecruiterFactory::class)->count(5)->create([
            'user_type' => 3,
        ]);
    }
}
