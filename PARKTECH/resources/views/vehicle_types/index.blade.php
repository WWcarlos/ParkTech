<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Tarifas y Tipos de Vehículos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="text-center mb-4">
        🚘 Configuración de Tipos de Vehículos

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    ← Volver al Dashboard
                </a>
    </h2>

    {{-- Formulario --}}
    <div class="card shadow mb-5">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Registrar Nuevo Tipo de Vehículo
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('vehicle_types.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre del Tipo
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Ej: Automóvil"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tarifa por Minuto (COP)
                        </label>

                        <input
                            type="number"
                            name="rate_per_minute"
                            class="form-control"
                            step="0.01"
                            min="0"
                            placeholder="100.00"
                            required>

                    </div>

                </div>

                <button class="btn btn-success">
                    Guardar Tipo
                </button>

            </form>

        </div>

    </div>

    {{-- Tabla --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                Tipos de Vehículos Registrados
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Tipo de Vehículo</th>
                            <th>Tarifa por Minuto</th>
                            <th width="180">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($vehicleTypes as $type)

                            <tr>

                                <td>{{ $type->id }}</td>

                                <td>{{ $type->name }}</td>

                                <td>
                                    <span class="badge bg-success fs-6">
                                        ${{ number_format($type->rate_per_minute,2,',','.') }} COP
                                    </span>
                                </td>

                                <td>

                                    <a
                                        href="{{ route('vehicle_types.edit',$type->id) }}"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route('vehicle_types.destroy',$type->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('¿Desea eliminar este tipo de vehículo?')"
                                            class="btn btn-danger btn-sm">

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">

                                    No existen tipos de vehículos registrados.

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