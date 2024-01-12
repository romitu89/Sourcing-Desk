<?php

// database/factories/ClientFactory.php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get a random user ID as the account manager
        $accountManagerId = User::inRandomOrder()->value('id');

        return [
            'client_name' => $this->faker->company,
            'business_unit_name' => $this->faker->word,
            'sub_location' => $this->faker->city,
            'account_manager' => $this->faker->name,
            'account_manager_id' => $accountManagerId,
        ];
    }
}
