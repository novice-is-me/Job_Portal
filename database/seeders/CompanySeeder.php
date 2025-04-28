<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyBenefit;
use App\Models\CompanyRecruiter;
use App\Models\CompanyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company seeder
        Company::factory()->count(5)->create();

        // Company Recuiter Seeder
        for ($i = 0; $i < 5; $i++) {
            CompanyRecruiter::create([
                'company_id' => rand(1, 5),
                'recruiter_id' => rand(1, 5),
            ]);
        }

        // Company Value Seeder
        for ($i = 0; $i < 5; $i++) {
            CompanyValue::create([
                'company_id' => rand(1, 5),
                'name' => 'Value ' . $i,
                'description' => 'Description of value ' . $i,
            ]);
        }

        // Company Benefit Seeder
        for ($i = 0; $i < 5; $i++) {
            CompanyBenefit::create([
                'company_id' => rand(1, 5),
                'name' => 'Benefit ' . $i,
                'description' => 'Description of benefit ' . $i,
            ]);
        }
    }
}
