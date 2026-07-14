<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkingRecordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('spaces', SpaceController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('vehicle_types', VehicleTypeController::class);
    Route::resource('users', UserController::class);
    Route::resource('parking-records', ParkingRecordController::class);
});

require __DIR__.'/auth.php';
