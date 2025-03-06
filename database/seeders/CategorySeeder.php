<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Web Development',
            'Mobile Development',
            'Desktop Development',
            'Game Development',
            'Machine Learning',
            'Data Science',
            'DevOps',
            'Testing',
            'UI/UX',
            'Security',
            'Network Engineer',
            'Cloud Computing',
            'IoT',
            'Blockchain',
            'Computer Services',
            'Database',
            'Software Engineering',
            'Frontend Developer',
            'Backend Developer',
            'Fullstack Developer',
            'Security Specialist',
            'System Analyst',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
