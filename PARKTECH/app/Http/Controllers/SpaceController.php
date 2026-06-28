<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;
use App\Models\VehicleType;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::with('vehicleType')->get();
        $vehicleTypes = VehicleType::all();
        
        return view('spaces.index', compact('spaces', 'vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:spaces,code|max:20',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'status' => 'required|in:FREE,OCCUPIED,MAINTENANCE',
        ]);

        $space = new Space;
        $space->code = $request->code;
        $space->vehicle_type_id = $request->vehicle_type_id;
        $space->status = $request->status;
        $space->save();

        return redirect()->route('spaces.index');
    }

    public function edit(string $id)
    {
        $space = Space::find($id);
        $vehicleTypes = VehicleType::all();
        
        return view('spaces.edit', compact('space', 'vehicleTypes'));
    }

    public function update(Request $request, string $id)
    {
        $space = Space::find($id);
        
        $request->validate([
            'code' => 'required|max:20|unique:spaces,code,' . $space->id,
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'status' => 'required|in:FREE,OCCUPIED,MAINTENANCE',
        ]);

        $space->code = $request->code;
        $space->vehicle_type_id = $request->vehicle_type_id;
        $space->status = $request->status;
        $space->save();

        return redirect()->route('spaces.index');  
    }

    public function destroy(string $id)
    {
        $space = Space::find($id);
        $space->delete();

        return redirect()->route('spaces.index');
    }
}
