<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Tarifas y Tipos</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Tipo de Vehículo</th>
                <th>Tarifa por Minuto</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicleTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>${{ $type->rate_per_minute }} COP</td>
                    <td>
                        <a href="{{ route('vehicle_types.edit', $type->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('vehicle_types.destroy', $type->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            <form action="{{ route('vehicle_types.store') }}" method="post">
                @csrf
                <div>
                    <label for="name">Nombre del Tipo</label>
                    <input type="text" id="name" name="name" placeholder="Ej: Automóvil, Motocicleta" required>
                </div>

                <div>
                    <label for="rate_per_minute">Tarifa por Minuto ($)</label>
                    <input type="number" id="rate_per_minute" name="rate_per_minute" step="0.01" min="0" placeholder="0.00" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Guardar Tipo</button>
            </form>
        </tbody>
    </table>
</body>
</html>