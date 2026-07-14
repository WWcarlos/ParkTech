<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Espacios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="text-center mb-4">
        🚗 Gestión de Espacios de Parqueo
    </h2>

    {{-- Formulario --}}
    <div class="card shadow mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registrar Nuevo Espacio</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('spaces.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Código</label>
                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            placeholder="Ej: A-01"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tipo de Vehículo</label>

                        <select name="vehicle_type_id" class="form-select" required>
                            <option value="">Seleccione...</option>

                            @foreach ($vehicleTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estado</label>

                        <select name="status" class="form-select">
                            <option value="FREE">Disponible</option>
                            <option value="OCCUPIED">Ocupado</option>
                            <option value="MAINTENANCE">Mantenimiento</option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-success">
                    Guardar Espacio
                </button>

            </form>

        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Listado de Espacios</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Tipo Vehículo</th>
                            <th>Estado</th>
                            <th width="180">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($spaces as $space)

                            <tr>

                                <td>{{ $space->id }}</td>

                                <td>{{ $space->code }}</td>

                                <td>{{ $space->vehicleType->name }}</td>

                                <td>

                                    @if($space->status == 'FREE')
                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    @elseif($space->status == 'OCCUPIED')

                                        <span class="badge bg-danger">
                                            Ocupado
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Mantenimiento
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('spaces.edit',$space->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('spaces.destroy',$space->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('¿Desea eliminar este espacio?')"
                                            class="btn btn-danger btn-sm">

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    No existen espacios registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>