<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        VehicleType::create([
            'name' => 'Motocicleta',
            'rate_per_minute' => 50
        ]);

        VehicleType::create([
            'name' => 'Automóvil',
            'rate_per_minute' => 100
        ]);

        VehicleType::create([
            'name' => 'Camioneta',
            'rate_per_minute' => 150
        ]);
    }
}