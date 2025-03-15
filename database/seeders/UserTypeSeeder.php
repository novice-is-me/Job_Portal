<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
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
    }
}
