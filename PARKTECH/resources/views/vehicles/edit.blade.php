<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="plate">Placa</label>
                <input type="text" id="plate" name="plate" value="{{ $vehicle->plate }}" required>
            </div>

            <div>
                <label for="vehicle_type_id">Tipo de vehiculo</label>
                <select id="vehicle_type_id" name="vehicle_type_id" required>
                    @foreach ($vehicleTypes as $type)
                        <option value="{{ $type->id }}" {{ $vehicle->vehicle_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }} (Minuto: ${{ $type->rate_per_minute }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
        </form>
    </table>
</body>
</html>