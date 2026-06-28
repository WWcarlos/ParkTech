<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
</head>
<body>
    <table>
        <form action="{{ route('spaces.update', $space->id) }}" method="post">
            @csrf
            @method('put')
            
            <div>
                <label for="code">Código de Espacio</label>
                <input type="text" id="code" name="code" value="{{ $space->code }}" required>
            </div>

            <div>
                <label for="vehicle_type_id">Tipo de Vehículo Permitido</label>
                <select id="vehicle_type_id" name="vehicle_type_id" required>
                    @foreach ($vehicleTypes as $type)
                        <option value="{{ $type->id }}" {{ $space->vehicle_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status">Estado del Espacio</label>
                <select id="status" name="status" required>
                    <option value="FREE" {{ $space->status == 'FREE' ? 'selected' : '' }}>FREE (Disponible)</option>
                    <option value="OCCUPIED" {{ $space->status == 'OCCUPIED' ? 'selected' : '' }}>OCCUPIED (Ocupado)</option>
                    <option value="MAINTENANCE" {{ $space->status == 'MAINTENANCE' ? 'selected' : '' }}>MAINTENANCE (Mantenimiento)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>
        </form>
    </table>
</body>
</html>