<!DOCTYPEDOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo de Vehiculo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->plate }}</td>
                    <td>{{ $vehicle->vehicleType->name }}</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <form action="{{ route('vehicles.store') }}" method="post">
                @csrf
                <div>
                    <label for="plate">Placa</label>
                    <input type="text" id="plate" name="plate" required>
                </div>

                <div>
                    <label for="vehicle_type_id">Tipo de vehiculo</label>
                    <select id="vehicle_type_id" name="vehicle_type_id" required>
                        <option value="">Seleccione un tipo...</option>
                        @foreach ($vehicleTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }} (Minuto: ${{ $type->rate_per_minute }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
            </form>
        </tbody>
    </table>
</body>
</html>