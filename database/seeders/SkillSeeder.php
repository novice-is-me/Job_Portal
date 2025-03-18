<?php

namespace Database\Seeders;

use App\Models\JobSkill;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $skills = [
            'PHP',
            'Laravel',
            'Vue.js',
            'React.js',
            'Angular',
            'Node.js',
            'Python',
            'Django',
            'Flask',
            'Ruby',
            'HTML/CSS',
            'JavaScript',
            'Tailwind CSS',
            'Bootstrap',
            'UI/UX Design',
            'Figma',
            'Graph QL',
            'REST API',
            'Docker',
            'Kubernetes',
            'AWS',
            'Mysql',
            'PostgreSQL',
            'MongoDB',
            'Next.js',
            'Nuxt.js',
            'Express.js',
        ];

        foreach($skills as $skill){
            Skill::create(['name' => $skill]);
        }

        // For job_skills seeder
        for($i = 0; $i < 10; $i++){
            JobSkill::create([
                'job_id' => rand(1, 10),
                'skill_id' => rand(1, 27),
            ]);
        }
    }
}
