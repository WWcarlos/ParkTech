<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h3 class="mb-0 text-center">
                        ✏️ Editar Espacio de Parqueo
                    </h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('spaces.update', $space->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Código del Espacio</label>
                            <input
                                type="text"
                                class="form-control"
                                name="code"
                                value="{{ $space->code }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de Vehículo</label>

                            <select
                                class="form-select"
                                name="vehicle_type_id"
                                required>

                                @foreach($vehicleTypes as $type)

                                    <option
                                        value="{{ $type->id }}"
                                        {{ $space->vehicle_type_id == $type->id ? 'selected' : '' }}>

                                        {{ $type->name }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Estado del Espacio
                            </label>

                            <select
                                class="form-select"
                                name="status"
                                required>

                                <option value="FREE"
                                    {{ $space->status == 'FREE' ? 'selected' : '' }}>
                                    Disponible
                                </option>

                                <option value="OCCUPIED"
                                    {{ $space->status == 'OCCUPIED' ? 'selected' : '' }}>
                                    Ocupado
                                </option>

                                <option value="MAINTENANCE"
                                    {{ $space->status == 'MAINTENANCE' ? 'selected' : '' }}>
                                    Mantenimiento
                                </option>

                            </select>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('spaces.index') }}"
                               class="btn btn-secondary">
                                ← Volver
                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                💾 Guardar Cambios

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>