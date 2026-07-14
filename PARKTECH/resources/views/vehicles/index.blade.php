<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="text-center mb-4">
        🚗 Gestión de Vehículos
    </h2>

    {{-- Formulario --}}
    <div class="card shadow mb-5">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Registrar Nuevo Vehículo
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('vehicles.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Placa
                        </label>

                        <input
                            type="text"
                            name="plate"
                            class="form-control"
                            placeholder="Ej: ABC123"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tipo de Vehículo
                        </label>

                        <select
                            name="vehicle_type_id"
                            class="form-select"
                            required>

                            <option value="">
                                Seleccione un tipo...
                            </option>

                            @foreach($vehicleTypes as $type)

                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                    - ${{ number_format($type->rate_per_minute,2,',','.') }} COP/min
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <button class="btn btn-success">
                    Guardar Vehículo
                </button>

            </form>

        </div>

    </div>

    {{-- Tabla --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                Vehículos Registrados
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Placa</th>
                            <th>Tipo de Vehículo</th>
                            <th>Tarifa</th>
                            <th width="180">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($vehicles as $vehicle)

                            <tr>

                                <td>{{ $vehicle->id }}</td>

                                <td>
                                    <strong>{{ strtoupper($vehicle->plate) }}</strong>
                                </td>

                                <td>
                                    {{ $vehicle->vehicleType->name }}
                                </td>

                                <td>
                                    <span class="badge bg-success fs-6">
                                        ${{ number_format($vehicle->vehicleType->rate_per_minute,2,',','.') }} COP/min
                                    </span>
                                </td>

                                <td>

                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Desea eliminar este vehículo?')">

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    No existen vehículos registrados.

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