<?php

namespace Database\Factories;

use App\Models\UserGovernmentData;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'number' => fake()->unique()->phoneNumber(),
            "gender" => fake()->randomElement(["male", "female", "other"]),
            "dob" => fake()->date(),
            "nationality" => fake()->country(),
            "address" => fake()->address(),
            'email_verified_at' => null,
        ];
    }

    public function withGovernmentData()
    {
        return $this->afterCreating(function (User $user) {
            UserGovernmentData::factory()->create(['user_id' => $user->id]);
        });
    }
}
