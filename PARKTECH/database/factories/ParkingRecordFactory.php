<?php

namespace Database\Factories;

use App\Models\ParkingRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Space;

/**
 * @extends Factory<ParkingRecord>
 */
class ParkingRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle = Vehicle::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $space = Space::inRandomOrder()->first();

        $entryTime = $this->faker->dateTimeBetween('-1 month', 'now');
        $status = $this->faker->randomElement(['ACTIVE', 'COMPLETED']);
        
        $exitTime = $status === 'COMPLETED' 
            ? $this->faker->dateTimeBetween($entryTime, 'now') 
            : null;

        $totalAmount = $status === 'COMPLETED' 
            ? $this->faker->randomFloat(2, 1000, 25000) 
            : null;

        return [
            'vehicle_id' => $vehicle->id,
            'user_id' => $user->id,
            'space_id' => $space->id,
            'entry_time' => $entryTime,
            'exit_time' => $exitTime,
            'total_amount' => $totalAmount,
            'status' => $status,
        ];
    }
}

