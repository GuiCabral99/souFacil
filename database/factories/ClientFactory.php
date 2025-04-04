<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'    => $this->faker->firstName(),
            'phone_number'  => $this->faker->phoneNumber(),
            'email'         => $this->faker->unique()->safeEmail(),
            'document'      => $this->faker->unique()->numerify('###.###.###-##'),
            'documentType'  => $this->faker->randomElement(['cpf', 'cnpj']),
            'user_id'       => User::factory(),
        ];
    }
}
