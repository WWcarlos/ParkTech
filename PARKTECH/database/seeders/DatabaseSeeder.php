<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleTypeSeeder::class,
            SpaceSeeder::class,
            VehicleSeeder::class,
            ParkingRecordSeeder::class,
        ]);
    }
}