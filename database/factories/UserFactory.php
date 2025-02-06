<?php

namespace Database\Factories;

use App\Models\UserGovernmentData;
use App\Models\User;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public $generatedPhoneNumbers = [];

    public function generatePhoneNumber(&$generatedPhoneNumbers)
    {
        // Ensure the generated phone number is unique
        do {
            $carrierCode = rand(97, 98);
            $number = rand(1000000, 9999999);
            $phoneNumber = "+977$carrierCode$number";
        } while (in_array($phoneNumber, $generatedPhoneNumbers));

        // Add the generated phone number to the array of used numbers
        $generatedPhoneNumbers[] = $phoneNumber;

        return $phoneNumber;
    }

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'number' => $this->generatePhoneNumber($this->generatedPhoneNumbers),
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
