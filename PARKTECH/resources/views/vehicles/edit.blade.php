<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h3 class="text-center mb-0">
                        🚗 Editar Vehículo
                    </h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Placa del Vehículo
                            </label>

                            <input
                                type="text"
                                name="plate"
                                class="form-control"
                                value="{{ $vehicle->plate }}"
                                placeholder="Ej: ABC123"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Tipo de Vehículo
                            </label>

                            <select
                                name="vehicle_type_id"
                                class="form-select"
                                required>

                                @foreach($vehicleTypes as $type)

                                    <option
                                        value="{{ $type->id }}"
                                        {{ $vehicle->vehicle_type_id == $type->id ? 'selected' : '' }}>

                                        {{ $type->name }} - ${{ number_format($type->rate_per_minute,2,',','.') }} COP/min

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('vehicles.index') }}"
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