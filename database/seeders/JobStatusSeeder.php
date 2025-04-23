<?php

namespace Database\Seeders;

use App\Models\JobStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $statuses = [
            'Pending',
            'Reviewed',
            'Rejected',
            'Interview',
        ];

        foreach ($statuses as $status) {
            JobStatus::create([
                'name' => $status,
            ]);
        }
    }
}
