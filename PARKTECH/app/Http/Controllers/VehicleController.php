<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleType;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('vehicleType')->get();
        $vehicleTypes = VehicleType::all();
        return view('vehicles.index', compact('vehicles', 'vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|unique:vehicles,plate',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
        ]);

        $vehicle = new Vehicle;
        $vehicle->plate = $request->plate;
        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }

    public function edit(string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicleTypes = VehicleType::all();   
        return view('vehicles.edit', compact('vehicle', 'vehicleTypes'));
    }

    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::find($id);

        $request->validate([
            'plate' => 'required|unique:vehicles,plate,' . $vehicle->id,
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
        ]);

        $vehicle->plate = $request->plate;
        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->save();

        return redirect()->route('vehicles.index');  
    }

    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index');
    }
}
