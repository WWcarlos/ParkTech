<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Registros de Parqueo</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0d6efd; padding-bottom: 10px; }
        .header h2 { color: #0d6efd; margin: 0; }
        .summary { margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .summary table { width: 100%; }
        .summary td { font-size: 14px; }
        .summary .bold { font-weight: bold; }
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data-table th, table.data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table.data-table th { background-color: #212529; color: white; }
        table.data-table tr:nth-child(even) { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .badge { padding: 3px 6px; border-radius: 3px; font-size: 10px; font-weight: bold; color: white; }
        .bg-active { background-color: #198754; }
        .bg-completed { background-color: #0dcaf0; color: #000; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sistema de Parqueaderos - ParkTech</h2>
        <p>Reporte General de Registros de Parqueo | Fecha de Emisión: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <td class="bold">Total de Registros:</td>
                <td>{{ $totalRecords }}</td>
                <td class="bold text-right">Total Recaudado:</td>
                <td class="text-right bold" style="color: #198754;">$ {{ number_format($totalRevenue, 2) }}</td>
            </tr>
        </table>
    </div>

    <h3>Listado de Ocupación</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Usuario Operador</th>
                <th>Espacio</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parkingRecords as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->vehicle->plate }}</td>
                    <td>{{ $record->user->name }}</td>
                    <td>{{ $record->space->code }}</td>
                    <td>{{ $record->entry_time }}</td>
                    <td>{{ $record->exit_time ?? 'En Parqueadero' }}</td>
                    <td>{{ $record->status }}</td>
                    <td class="text-right">$ {{ number_format($record->total_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>