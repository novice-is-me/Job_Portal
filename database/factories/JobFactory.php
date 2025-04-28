<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Job::class;

    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->jobTitle,
            'content' => $this->faker->text,
            'status' => $this->faker->randomElement(['Active', 'Urgent']),
            'work_setup' => $this->faker->randomElement(['Remote', 'Onsite', 'Hybrid']),
            'address' => $this->faker->address,
            'company_id' => $this->faker->numberBetween(1, 5),
            'salary' => $this->faker->numberBetween(1000, 10000),
            'type' => $this->faker->randomElement(['Full time', 'Part time', 'Contract']),
            'category_id' => $this->faker->numberBetween(1, 22),
            'recruiter_id' => $this->faker->numberBetween(1, 5),
            'experience_id' => $this->faker->numberBetween(1, 6),
            'about_role' => $this->faker->text
        ];
    }
}
