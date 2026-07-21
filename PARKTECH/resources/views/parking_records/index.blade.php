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
            <!-- NUEVO: Alerta en caso de error (como parqueadero lleno) -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- RF-15: Tarjetas de Control de Cupos -->
            <h5 class="mb-3">Control de Cupos</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-success text-white text-center shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Cupos Disponibles</h6>
                            <h2 class="display-6 font-weight-bold">{{ $freeSpaces }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white text-center shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Cupos Ocupados</h6>
                            <h2 class="display-6 font-weight-bold">{{ $occupiedSpaces }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-secondary text-white text-center shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Capacidad Total</h6>
                            <h2 class="display-6 font-weight-bold">{{ $totalSpaces }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Nuevo Registro</h5>

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
                                    {{ $space->code }}
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
                            <!-- <option value="COMPLETED">COMPLETED</option> -->
                        </select>
                    </div>

                </div>

                <button class="btn btn-success">
                    Guardar Registro
                </button>

            </form>

            <hr>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Listado de Registros</h5>
                
                <!-- Restricción visual en Blade para el Administrador -->
                @if(auth()->check() && auth()->user()->role === 'ADMIN')
                    <a href="{{ route('parking-records.report-pdf') }}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill me-1" viewBox="0 0 16 16">
                            <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.508-.077-.004-.115-.053-.13-.105-.031-.1-.011-.277.156-.471zm2.76-.206c.166-.076.32-.156.459-.238.167.194.187.371.156.47-.015.053-.053.102-.13.106-.137.008-.355-.17-.636-.508a7.92 7.92 0 0 1-.45-.606z"/>
                            <path d="M13.293 3.688a.8.8 0 0 0-.242-.557l-2.83-2.83a.8.8 0 0 0-.557-.242H3.75A1.5 1.5 0 0 0 2.25 1.5v13A1.5 1.5 0 0 0 3.75 16h8.5a1.5 1.5 0 0 0 1.5-1.5V4.414a.8.8 0 0 0-.242-.557zM11.5 4.5V1.707L14.293 4.5H11.5zM6.027 10.925a6.6 6.6 0 0 1 1.484-.367c.465-.08.941-.105 1.425-.074.596.039 1.156.139 1.657.297.27.085.433.248.45.424.013.14-.047.361-.253.537-.207.176-.49.246-.74.21-.42-.06-.897-.33-1.365-.77a11.573 11.573 0 0 0-1.927-.254 7.285 7.285 0 0 0-1.54.18c-.347.09-.642.23-.872.4-.226.167-.396.34-.473.5-.074.156-.043.33.093.454.144.132.302.149.406.116.204-.065.42-.254.654-.546a8.882 8.882 0 0 1 .502-.58z"/>
                        </svg>
                        Exportar Reporte PDF
                    </a>
                @endif
            </div>

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
                        <th width="250">Acciones</th>
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

                        <td>{{ $record->exit_time }}</td>

                        <td>{{ $record->status }}</td>

                        <td>$ {{ $record->total_amount }}</td>

                        <td>
                            <!-- Botón Dar Salida (Solo si está activo) -->
                            @if($record->status === 'ACTIVE')
                                <form action="{{ route('parking-records.checkout', $record->id) }}" 
                                    method="POST" 
                                    style="display:inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm">
                                        Dar Salida
                                    </button>
                                </form>
                            @endif

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
            {{ $parkingRecords->links() }}

        </div>

    </div>

</div>

</body>
</html>