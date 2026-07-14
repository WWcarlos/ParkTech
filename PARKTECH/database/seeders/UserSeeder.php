<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@parking.com',
            'password' => Hash::make('12345678'),
            'role' => 'ADMIN',
            'is_active' => true
        ]);

        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@parking.com',
            'password' => Hash::make('12345678'),
            'role' => 'OPERADOR',
            'is_active' => true
        ]);

        User::create([
            'name' => 'María Gómez',
            'email' => 'maria@parking.com',
            'password' => Hash::make('12345678'),
            'role' => 'USER',
            'is_active' => true
        ]);
    }
}