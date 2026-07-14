<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h3 class="text-center mb-0">
                        ✏️ Editar Usuario
                    </h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $user->name }}"
                                required>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Correo Electrónico
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ $user->email }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Nueva Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Dejar en blanco para conservar la actual">

                            <small class="text-muted">
                                Solo escriba una contraseña si desea cambiarla.
                            </small>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Rol
                            </label>

                            <select
                                name="role"
                                class="form-select"
                                required>

                                <option value="ADMIN"
                                    {{ $user->role == 'ADMIN' ? 'selected' : '' }}>
                                    Administrador
                                </option>

                                <option value="OPERADOR"
                                    {{ $user->role == 'OPERADOR' ? 'selected' : '' }}>
                                    Operador
                                </option>

                                <option value="USER"
                                    {{ $user->role == 'USER' ? 'selected' : '' }}>
                                    Usuario
                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Estado
                            </label>

                            <select
                                name="is_active"
                                class="form-select"
                                required>

                                <option value="1"
                                    {{ $user->is_active ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="0"
                                    {{ !$user->is_active ? 'selected' : '' }}>
                                    Inactivo
                                </option>

                            </select>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('users.index') }}"
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