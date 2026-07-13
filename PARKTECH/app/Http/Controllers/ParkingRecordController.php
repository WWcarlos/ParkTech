<?php

namespace App\Http\Controllers;

use App\Models\ParkingRecord;
use Illuminate\Http\Request;

class ParkingRecordController extends Controller
{
    /**
     * Mostrar todos los registros.
     */
    public function index()
    {
        $parkingRecords = ParkingRecord::with([
            'vehicle',
            'user',
            'space'
        ])->get();

        return response()->json($parkingRecords);
    }

    /**
     * Guardar un nuevo registro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'user_id'      => 'required|exists:users,id',
            'space_id'     => 'required|exists:spaces,id',
            'entry_time'   => 'required|date',
            'exit_time'    => 'nullable|date|after_or_equal:entry_time',
            'total_amount' => 'nullable|numeric|min:0',
            'status'       => 'required|in:ACTIVE,COMPLETED',
        ]);

        $parkingRecord = ParkingRecord::create($validated);

        return response()->json([
            'message' => 'Registro creado correctamente.',
            'data' => $parkingRecord
        ], 201);
    }

    /**
     * Mostrar un registro específico.
     */
    public function show(string $id)
    {
        $parkingRecord = ParkingRecord::with([
            'vehicle',
            'user',
            'space'
        ])->findOrFail($id);

        return response()->json($parkingRecord);
    }

    /**
     * Actualizar un registro.
     */
    public function update(Request $request, string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);

        $validated = $request->validate([
            'vehicle_id'   => 'sometimes|exists:vehicles,id',
            'user_id'      => 'sometimes|exists:users,id',
            'space_id'     => 'sometimes|exists:spaces,id',
            'entry_time'   => 'sometimes|date',
            'exit_time'    => 'nullable|date|after_or_equal:entry_time',
            'total_amount' => 'nullable|numeric|min:0',
            'status'       => 'sometimes|in:ACTIVE,COMPLETED',
        ]);

        $parkingRecord->update($validated);

        return response()->json([
            'message' => 'Registro actualizado correctamente.',
            'data' => $parkingRecord
        ]);
    }

    /**
     * Eliminar un registro.
     */
    public function destroy(string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);

        $parkingRecord->delete();

        return response()->json([
            'message' => 'Registro eliminado correctamente.'
        ]);
    }
}