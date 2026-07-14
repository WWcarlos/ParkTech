<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::insert([
            [
                'plate'=>'ABC123',
                'vehicle_type_id'=>2,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'plate'=>'XYZ789',
                'vehicle_type_id'=>2,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'plate'=>'MTR456',
                'vehicle_type_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'plate'=>'JKL987',
                'vehicle_type_id'=>3,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'plate'=>'QWE741',
                'vehicle_type_id'=>2,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
    }
}