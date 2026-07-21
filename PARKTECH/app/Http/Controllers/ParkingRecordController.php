<?php

namespace App\Http\Controllers;

use App\Models\ParkingRecord;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ParkingRecordController extends Controller
{
    public function index()
    {
        $parkingRecords = ParkingRecord::with(['vehicle', 'user', 'space'])->paginate(10);
        $vehicles = Vehicle::all();
        $users = User::all();
        $spaces = Space::where('status', 'FREE')->get();

        return view('parking_records.index', array_merge(
            compact('parkingRecords', 'vehicles', 'users', 'spaces'),
            $this->getSpaceMetrics()
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'user_id'      => 'required|exists:users,id',
            'space_id'     => 'required|exists:spaces,id',
            'entry_time'   => 'required|date',
            'status'       => 'required|in:ACTIVE,COMPLETED',
        ]);

        $validationError = $this->validateSpaceAvailability($request->space_id);
        if ($validationError) {
            return redirect()->back()->withInput()->with('error', $validationError);
        }

        $activeRecord = ParkingRecord::where('vehicle_id', $request->vehicle_id)
            ->where('status', 'ACTIVE')
            ->exists();

        if ($activeRecord) {
            return redirect()->back()->withInput()->with('error', 'El vehículo seleccionado ya se encuentra dentro del parqueadero y no ha registrado su salida.');
        }

        DB::transaction(function () use ($request) {
            ParkingRecord::create($request->all());

            $selectedSpace = Space::findOrFail($request->space_id);
            $selectedSpace->status = 'OCCUPIED';
            $selectedSpace->save();
        });

        return redirect()->route('parking-records.index')
            ->with('success', 'Registro creado correctamente.');
    }

    public function edit(string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);
        $vehicles = Vehicle::all();
        $users = User::all();
        $spaces = Space::all();

        return view('parking_records.edit', compact('parkingRecord', 'vehicles', 'users', 'spaces'));
    }

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

    public function destroy(string $id)
    {
        $parkingRecord = ParkingRecord::findOrFail($id);
        $parkingRecord->delete();

        return redirect()->route('parking-records.index')
            ->with('success', 'Registro eliminado correctamente.');
    }


    
    /**
     * Procesar la salida del vehículo.
     */
    public function checkout(string $id)
    {
        $record = ParkingRecord::findOrFail($id);

        if ($record->status === 'COMPLETED') {
            return redirect()->route('parking-records.index')
                ->with('error', 'Este vehículo ya tiene registrada su salida.');
        }

        DB::transaction(function () use ($record) {
            $now = Carbon::now();
            $totalAmount = $this->calculateParkingFee($record, $now);

            $record->update([
                'exit_time' => $now,
                'total_amount' => $totalAmount,
                'status' => 'COMPLETED'
            ]);

            // Liberar el espacio de forma directa para evitar problemas de MassAssignment
            if ($record->space) {
                $record->space->status = 'FREE';
                $record->space->save();
            }
            Log::info("Salida registrada para el vehículo {$record->vehicle->plate}. Cobro: {$totalAmount}", [
                    'user_id' => auth()->id(),
                    'parking_record_id' => $record->id
                ]); //Se encarga del atributo de calidad Logging
        });


        return redirect()->route('parking-records.index')
            ->with('success', 'Salida registrada correctamente. Tarifa calculada.');
    }

    public function generatePdfReport()
    {
        $parkingRecords = ParkingRecord::with(['vehicle', 'user', 'space'])->get();
        $totalRecords = $parkingRecords->count();
        $totalRevenue = $parkingRecords->sum('total_amount');

        $pdf = Pdf::loadView('parking_records.report-pdf', compact('parkingRecords', 'totalRecords', 'totalRevenue'));
        
        return $pdf->download('reporte-parqueadero-' . date('Y-m-d') . '.pdf');
    }

    /*
    | MÉTODOS PRIVADOS DE SOPORTE (Modularizado)
    */

    private function getSpaceMetrics(): array
    {
        return [
            'totalSpaces'    => Space::count(),
            'occupiedSpaces' => Space::where('status', 'OCCUPIED')->count(),
            'freeSpaces'     => Space::where('status', 'FREE')->count(),
        ];
    }

    /**
     * Valida si el parqueadero está lleno o si el espacio seleccionado no está libre.
     */
    private function validateSpaceAvailability(int $spaceId): ?string
    {
        if (Space::where('status', 'FREE')->count() === 0) {
            return 'No es posible registrar el ingreso: El parqueadero está lleno.';
        }

        $selectedSpace = Space::findOrFail($spaceId);
        if ($selectedSpace->status !== 'FREE') {
            return 'El espacio seleccionado (' . $selectedSpace->code . ') ya se encuentra ocupado.';
        }

        return null;
    }

    /**
     * Calcula la tarifa final basándose en el tiempo transcurrido y tipo de vehículo.
     */
    private function calculateParkingFee(ParkingRecord $record, Carbon $now): float
    {
        $entryTime = Carbon::parse($record->entry_time);
        $minutes = max(1, $entryTime->diffInMinutes($now));

        $ratePerMinute = 0;
        if ($record->space && $record->space->vehicle_type_id) {
            $vehicleType = DB::table('vehicle_types')->where('id', $record->space->vehicle_type_id)->first();
            if ($vehicleType) {
                $ratePerMinute = $vehicleType->rate_per_minute;
            }
        }

        $totalAmount = $minutes * $ratePerMinute;

        // Límite de seguridad para evitar desbordamiento en DECIMAL(10,2)
        $maxLimit = 99999999.99;
        return min($totalAmount, $maxLimit);
    }

}