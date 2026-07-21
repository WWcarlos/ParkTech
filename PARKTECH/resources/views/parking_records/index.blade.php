<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Parqueo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Gestión de Registros de Parqueo</h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Encabezado con botón de regreso -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Nuevo Registro</h5>

                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    ← Volver al Dashboard
                </a>
            </div>

            <form action="{{ route('parking-records.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-2 mb-3">
                        <label>Vehículo</label>
                        <select name="vehicle_id" class="form-control" required>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">
                                    {{ $vehicle->plate }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Usuario</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Espacio</label>
                        <select name="space_id" class="form-control" required>
                            @foreach($spaces as $space)
                                <option value="{{ $space->id }}">
                                    {{ $space->space_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Hora Entrada</label>
                        <input type="datetime-local" name="entry_time" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Estado</label>
                        <select name="status" class="form-control">
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="COMPLETED">COMPLETED</option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-success">
                    Guardar Registro
                </button>

            </form>

            <hr>

            <h5>Listado de Registros</h5>

            <table class="table table-bordered table-hover mt-3">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Vehículo</th>
                        <th>Usuario</th>
                        <th>Espacio</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th width="170">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($parkingRecords as $record)

                    <tr>

                        <td>{{ $record->id }}</td>

                        <td>{{ $record->vehicle->plate }}</td>

                        <td>{{ $record->user->name }}</td>

                        <td>{{ $record->space->space_number }}</td>

                        <td>{{ $record->entry_time }}</td>

                        <td>{{ $record->exit_time }}</td>

                        <td>{{ $record->status }}</td>

                        <td>$ {{ $record->total_amount }}</td>

                        <td>

                            <a href="{{ route('parking-records.edit', $record->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('parking-records.destroy', $record->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                    Eliminar
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>