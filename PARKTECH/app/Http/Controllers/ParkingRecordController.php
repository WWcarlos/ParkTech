<?php

namespace App\Http\Controllers;

use App\Models\ParkingRecord;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;

class ParkingRecordController extends Controller
{
    /**
     * Mostrar la lista de registros.
     */
    public function index()
    {
        $parkingRecords = ParkingRecord::with(['vehicle', 'user', 'space'])->get();
        $vehicles = Vehicle::all();
        $users = User::all();
        $spaces = Space::all();

        return view('parking_records.index', compact(
            'parkingRecords',
            'vehicles',
            'users',
            'spaces'
        ));
    }

    /**
     * Guardar un nuevo registro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'user_id'      => 'required|exists:users,id',
            'space_id'     => 'required|exists:spaces,id',
            'entry_time'   => 'required|date',
            'exit_time'    => 'nullable|date|after_or_equal:entry_time',
            'total_amount' => 'nullable|numeric|min:0',
            'status'       => 'required|in:ACTIVE,COMPLETED',
        ]);

        ParkingRecord::create($request->all());

        return redirect()->route('parking-records.index')
            ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);
        $vehicles = Vehicle::all();
        $users = User::all();
        $spaces = Space::all();

        return view('parking_records.edit', compact(
            'parkingRecord',
            'vehicles',
            'users',
            'spaces'
        ));
    }

    /**
     * Actualizar un registro.
     */
    public function update(Request $request, string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);

        $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'user_id'      => 'required|exists:users,id',
            'space_id'     => 'required|exists:spaces,id',
            'entry_time'   => 'required|date',
            'exit_time'    => 'nullable|date|after_or_equal:entry_time',
            'total_amount' => 'nullable|numeric|min:0',
            'status'       => 'required|in:ACTIVE,COMPLETED',
        ]);

        $parkingRecord->update($request->all());

        return redirect()->route('parking-records.index')
            ->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Eliminar un registro.
     */
    public function destroy(string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);

        $parkingRecord->delete();

        return redirect()->route('parking-records.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}