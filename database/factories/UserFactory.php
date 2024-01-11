<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_name' => $this->faker->name,
            'username' => $this->faker->userName,
            'password' => bcrypt('password'), // Change this to generate a secure password
            'employee_id' => $this->faker->unique()->randomNumber,
            'mobile_number' => $this->faker->phoneNumber,
            'email_id' => $this->faker->unique()->safeEmail,
            'location' => $this->faker->city,
            'department' => $this->faker->word,
            'role' => $this->faker->randomElement(['accountManager', 'teamLead']),
            'reporting_to' => $this->faker->randomElement(['accountManager', 'teamLead']),
            'dob' => $this->faker->date,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
