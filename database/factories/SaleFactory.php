<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'date' => $this->faker->date(),
            'received' => $this->faker->boolean(50),
            'delivered' => $this->faker->boolean(50),
        ];
    }
}
