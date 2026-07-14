<?php

namespace Database\Seeders;

use App\Models\ParkingRecord;
use Illuminate\Database\Seeder;

class ParkingRecordSeeder extends Seeder
{
    public function run(): void
    {
        ParkingRecord::create([
            'vehicle_id'=>1,
            'user_id'=>2,
            'space_id'=>6,
            'entry_time'=>now()->subHours(2),
            'exit_time'=>now(),
            'total_amount'=>12000,
            'status'=>'COMPLETED'
        ]);

        ParkingRecord::create([
            'vehicle_id'=>2,
            'user_id'=>2,
            'space_id'=>7,
            'entry_time'=>now()->subMinutes(40),
            'status'=>'ACTIVE'
        ]);

        ParkingRecord::create([
            'vehicle_id'=>3,
            'user_id'=>3,
            'space_id'=>1,
            'entry_time'=>now()->subHour(),
            'exit_time'=>now(),
            'total_amount'=>3000,
            'status'=>'COMPLETED'
        ]);

        ParkingRecord::create([
            'vehicle_id'=>4,
            'user_id'=>2,
            'space_id'=>16,
            'entry_time'=>now()->subHours(5),
            'exit_time'=>now(),
            'total_amount'=>45000,
            'status'=>'COMPLETED'
        ]);
    }
}