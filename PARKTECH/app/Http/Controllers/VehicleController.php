<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
   public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $vehicle = new Vehicle;
        $vehicle->placa = $request->placa;
        $vehicle->tipo_vehiculo = $request->tipo_vehiculo;
        $vehicle->marca = $request->marca;
        $vehicle->color = $request->color;
        $vehicle->propietario = $request->propietario;
        $vehicle->telefono = $request->telefono;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }

    public function edit(string $id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->placa = $request->placa;
        $vehicle->tipo_vehiculo = $request->tipo_vehiculo;
        $vehicle->marca = $request->marca;
        $vehicle->color = $request->color;
        $vehicle->propietario = $request->propietario;
        $vehicle->telefono = $request->telefono;
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
