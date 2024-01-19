<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Login>
 */
class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'ip_address' => $this->faker->ipv4,
            'email_id' => $this->faker->unique()->safeEmail,
            'location' => $this->faker->city,
            'logout_time' => $this->faker->optional()->dateTimeThisYear,
            'created_at' => $this->faker->dateTimeThisMonth,
            'updated_at' => now(),
        ];
    }
}
