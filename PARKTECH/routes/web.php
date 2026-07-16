<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkingRecordController;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Space;
use App\Models\ParkingRecord;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'usuarios'  => User::count(),
        'vehiculos' => Vehicle::count(),
        'espacios'  => Space::count(),
        'registros' => ParkingRecord::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================
// RUTAS PARA TODOS LOS USUARIOS AUTENTICADOS
// ==========================

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// ==========================
// SOLO ADMIN
// ==========================

Route::middleware(['auth', 'role:ADMIN'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('spaces', SpaceController::class);
    Route::resource('vehicle_types', VehicleTypeController::class);

});


// ==========================
// TODOS
// ==========================

Route::middleware(['auth', 'role:ADMIN,OPERADOR,USER'])->group(function () {

    Route::resource('vehicles', VehicleController::class);
    Route::resource('parking-records', ParkingRecordController::class);
    Route::put('/parking-records/{id}/checkout', [ParkingRecordController::class, 'checkout'])->name('parking-records.checkout');

});



require __DIR__.'/auth.php';