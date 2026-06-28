<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Vehículo</title>
</head>
<body>
    <table>
        <form action="{{ route('vehicle_types.update', $vehicleType->id) }}" method="post">
            @csrf
            @method('put')
            
            <div>
                <label for="name">Nombre del Tipo</label>
                <input type="text" id="name" name="name" value="{{ $vehicleType->name }}" required>
            </div>

            <div>
                <label for="rate_per_minute">Tarifa por Minuto ($)</label>
                <input type="number" id="rate_per_minute" name="rate_per_minute" step="0.01" min="0" value="{{ $vehicleType->rate_per_minute }}" required>
            </div>

            <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
        </form>
    </table>
</body>
</html>