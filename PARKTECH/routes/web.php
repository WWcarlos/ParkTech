<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\UserController;

Route::resource('spaces', SpaceController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('vehicle_types', VehicleTypeController::class);
Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('welcome');
});
