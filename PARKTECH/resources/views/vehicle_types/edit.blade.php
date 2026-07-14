<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Vehículo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h3 class="text-center mb-0">
                        ✏️ Editar Tipo de Vehículo
                    </h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('vehicle_types.update', $vehicleType->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre del Tipo de Vehículo
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $vehicleType->name }}"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Tarifa por Minuto (COP)
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">$</span>

                                <input
                                    type="number"
                                    name="rate_per_minute"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    value="{{ $vehicleType->rate_per_minute }}"
                                    required>

                                <span class="input-group-text">COP</span>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('vehicle_types.index') }}"
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