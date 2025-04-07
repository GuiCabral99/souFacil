<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            Sale::factory(5)->create([
                'client_id' => $client->id
            ]);
        }
    }
}
