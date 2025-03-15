<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Company::class;
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'email' => $this->faker->unique()->safeEmail,
            'image' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'no_employees' => $this->faker->numberBetween(10, 1000),
        ];
    }
}
