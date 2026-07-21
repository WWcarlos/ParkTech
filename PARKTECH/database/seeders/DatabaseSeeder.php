<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Space;
use App\Models\Vehicle;
use App\Models\ParkingRecord;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
                    VehicleTypeSeeder::class,
                    UserSeeder::class,
                    SpaceSeeder::class,
                    VehicleSeeder::class,
                    ParkingRecordSeeder::class,
                ]);

                User::factory()->count(20)->create();
                Space::factory()->count(50)->create();
                Vehicle::factory()->count(100)->create();
                ParkingRecord::factory()->count(300)->create();
    }
}

