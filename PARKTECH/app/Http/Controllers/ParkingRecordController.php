<?php

namespace App\Http\Controllers;

use App\Models\ParkingRecord;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $spaces = Space::where('status', 'FREE')->get();

        $totalSpaces = Space::count();
        $occupiedSpaces = Space::where('status', 'OCCUPIED')->count();
        $freeSpaces = Space::where('status', 'FREE')->count();

        return view('parking_records.index', compact(
            'parkingRecords',
            'vehicles',
            'users',
            'spaces',
            'totalSpaces',     
            'occupiedSpaces',   
            'freeSpaces'        
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
            'status'       => 'required|in:ACTIVE,COMPLETED',
        ]);

        $freeSpacesCount = Space::where('status', 'FREE')->count();
        if ($freeSpacesCount === 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No es posible registrar el ingreso: El parqueadero está lleno.');
        }

        $selectedSpace = Space::findOrFail($request->space_id);
        if ($selectedSpace->status !== 'FREE') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El espacio seleccionado (' . $selectedSpace->code . ') ya se encuentra ocupado.');
        }

        DB::transaction(function () use ($request, $selectedSpace) {
            ParkingRecord::create($request->all());

            $selectedSpace->status = 'OCCUPIED';
            $selectedSpace->save();
        });

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

    public function checkout(string $id)
    {
        DB::transaction(function () use ($id) {
            $record = ParkingRecord::findOrFail($id);

            if ($record->status === 'COMPLETED') {
                return redirect()->route('parking-records.index')
                    ->with('error', 'Este vehículo ya tiene registrada su salida.');
            }

            $now = Carbon::now();
            $entryTime = Carbon::parse($record->entry_time);

            // Calcular minutos transcurridos (mínimo 1 minuto)
            $minutes = max(1, $entryTime->diffInMinutes($now));

            // Obtener la tarifa buscando el tipo de vehículo asociado al espacio
            $ratePerMinute = 0;
            if ($record->space && $record->space->vehicle_type_id) {
                $vehicleType = DB::table('vehicle_types')->where('id', $record->space->vehicle_type_id)->first();
                if ($vehicleType) {
                    $ratePerMinute = $vehicleType->rate_per_minute;
                }
            }

            $totalAmount = $minutes * $ratePerMinute;

            // 1. Calcular el monto total
            $totalAmount = $minutes * $ratePerMinute;

            // 2. AGREGAR ESTA VALIDACIÓN DE SEGURIDAD (Para evitar desbordamiento decimal)
            // El máximo permitido por DECIMAL(10,2) es 99999999.99
            $maxLimit = 99999999.99;
            if ($totalAmount > $maxLimit) {
                $totalAmount = $maxLimit;
            }

            // 3. Actualizar el registro (Línea 136 de tu captura)
            $record->update([
                'exit_time' => $now,
                'total_amount' => $totalAmount,
                'status' => 'COMPLETED'
            ]);

            // Actualizar el registro
            $record->update([
                'exit_time' => $now,
                'total_amount' => $totalAmount,
                'status' => 'COMPLETED'
            ]);

            // Liberar el espacio (Cambiar estado de OCCUPIED a FREE)
            if ($record->space) {
                $record->space->update(['status' => 'FREE']);
            }
        });

        return redirect()->route('parking-records.index')
            ->with('success', 'Salida registrada correctamente. Tarifa calculada.');
    }

    /**
     * Generar reporte en PDF de los registros actuales (Solo ADMIN).
     */
    public function generatePdfReport()
    {
        // Traemos todos los registros con sus relaciones para el reporte
        $parkingRecords = ParkingRecord::with(['vehicle', 'user', 'space'])->get();
        
        // Contadores básicos para el encabezado del reporte
        $totalRecords = $parkingRecords->count();
        $totalRevenue = $parkingRecords->sum('total_amount');

        // Cargamos una vista exclusiva para el diseño del PDF
        $pdf = Pdf::loadView('parking_records.report-pdf', compact('parkingRecords', 'totalRecords', 'totalRevenue'));
        
        // Descarga el archivo automáticamente con la fecha actual
        return $pdf->download('reporte-parqueadero-' . date('Y-m-d') . '.pdf');
    }
}