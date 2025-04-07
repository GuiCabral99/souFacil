<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'phone_number' => $this->faker->unique()->numerify('#############'),
            'email' => $this->faker->unique()->safeEmail,
            'document' => $this->faker->unique()->numerify('###########'),
            'documentType' => $this->faker->randomElement(['cpf', 'cnpj']),
        ];
    }
}
