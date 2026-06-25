<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\VehicleController;

Route::resource('spaces', SpaceController::class);
Route::resource('vehicles', VehicleController::class);

Route::get('/', function () {
    return view('welcome');
});
