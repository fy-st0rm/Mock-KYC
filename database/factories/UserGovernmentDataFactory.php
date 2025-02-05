<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserGovernmentDataFactory extends Factory
{
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "id_type" => fake()->randomElement(['Passport', 'National ID', 'Driver License']),
            "id_number" => fake()->unique()->regexify('[A-Z0-9]{8,12}'),
            "issued_country" => fake()->country(),
        ];
    }
}
