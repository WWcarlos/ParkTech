<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;

Route::resource('spaces', SpaceController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('vehicle_types', VehicleTypeController::class);

Route::get('/', function () {
    return view('welcome');
});
