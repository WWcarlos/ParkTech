<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VehicleType;

/**
 * @extends Factory<Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('?-##'), 
            'vehicle_type_id' => VehicleType::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['FREE', 'OCCUPIED', 'MAINTENANCE']),
        ];
    }
}
