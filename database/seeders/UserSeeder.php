<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário Admin
        User::create([
            'first_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123123',
            'role' => 'admin',
        ]);

        // Usuários comuns
        User::factory(5)->create();
    }
}
