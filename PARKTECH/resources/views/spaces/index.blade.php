<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Espacios</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Código de Espacio</th>
                <th>Tipo de Vehículo Asignado</th>
                <th>Estado Actual</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($spaces as $space)
                <tr>
                    <td>{{ $space->code }}</td>
                    <td>{{ $space->vehicleType->name }}</td>
                    <td>{{ $space->status }}</td>
                    <td>
                        <a href="{{ route('spaces.edit', $space->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('spaces.destroy', $space->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <form action="{{ route('spaces.store') }}" method="post">
                @csrf
                <div>
                    <label for="code">Código de Espacio</label>
                    <input type="text" id="code" name="code" placeholder="Ej: A-01" required>
                </div>

                <div>
                    <label for="vehicle_type_id">Tipo de Vehículo Permitido</label>
                    <select id="vehicle_type_id" name="vehicle_type_id" required>
                        <option value="">Seleccione un tipo...</option>
                        @foreach ($vehicleTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status">Estado Inicial</label>
                    <select id="status" name="status" required>
                        <option value="FREE" selected>FREE (Disponible)</option>
                        <option value="OCCUPIED">OCCUPIED (Ocupado)</option>
                        <option value="MAINTENANCE">MAINTENANCE (Mantenimiento)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Guardar Espacio</button>
            </form>
        </tbody>
    </table>
</body>
</html>