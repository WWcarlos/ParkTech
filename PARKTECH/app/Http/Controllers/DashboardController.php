<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Space;
use App\Models\ParkingRecord;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'usuarios' => User::count(),
            'vehiculos' => Vehicle::count(),
            'espacios' => Space::count(),
            'registros' => ParkingRecord::count(),
        ]);
    }
}