<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('vehicle_types.index', compact('vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vehicle_types,name|max:100',
            'rate_per_minute' => 'required|numeric|min:0',
        ]);

        $vehicleType = new VehicleType;
        $vehicleType->name = $request->name;
        $vehicleType->rate_per_minute = $request->rate_per_minute;
        $vehicleType->save();
        return redirect()->route('vehicle_types.index');
    }

    public function edit(string $id)
    {
        $vehicleType = VehicleType::find($id);
        return view('vehicle_types.edit', compact('vehicleType'));
    }

    public function update(Request $request, string $id)
    {
        $vehicleType = VehicleType::find($id);

        $request->validate([
            'name' => 'required|max:100|unique:vehicle_types,name,' . $vehicleType->id,
            'rate_per_minute' => 'required|numeric|min:0',
        ]);

        $vehicleType->name = $request->name;
        $vehicleType->rate_per_minute = $request->rate_per_minute;
        $vehicleType->save();
        return redirect()->route('vehicle_types.index');  
    }

    public function destroy(string $id)
    {
        $vehicleType = VehicleType::find($id);
        $vehicleType->delete();
        return redirect()->route('vehicle_types.index');
    }
}