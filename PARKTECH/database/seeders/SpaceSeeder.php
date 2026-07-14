<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    public function run(): void
    {
        // Motocicletas
        for($i=1;$i<=5;$i++){
            Space::create([
                'code' => 'M0'.$i,
                'vehicle_type_id' => 1,
                'status' => 'FREE'
            ]);
        }

        // Automóviles
        for($i=1;$i<=10;$i++){
            Space::create([
                'code' => 'A'.str_pad($i,2,'0',STR_PAD_LEFT),
                'vehicle_type_id' => 2,
                'status' => 'FREE'
            ]);
        }

        // Camionetas
        for($i=1;$i<=5;$i++){
            Space::create([
                'code' => 'C0'.$i,
                'vehicle_type_id' => 3,
                'status' => 'FREE'
            ]);
        }
    }
}