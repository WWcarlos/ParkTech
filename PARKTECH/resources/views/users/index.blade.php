<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="text-center mb-4">
        👥 Gestión de Usuarios

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    ← Volver al Dashboard
                </a>
    </h2>

    {{-- Formulario --}}
    <div class="card shadow mb-5">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registrar Nuevo Usuario</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Correo Electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Rol
                        </label>

                        <select
                            class="form-select"
                            name="role"
                            required>

                            <option value="">Seleccione...</option>
                            <option value="ADMIN">Administrador</option>
                            <option value="OPERADOR">Operador</option>
                            <option value="USER">Usuario</option>

                        </select>

                    </div>

                    <div class="col-12">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                checked>

                            <label
                                class="form-check-label"
                                for="is_active">

                                Usuario Activo

                            </label>

                        </div>

                    </div>

                </div>

                <button class="btn btn-success mt-3">
                    Guardar Usuario
                </button>

            </form>

        </div>

    </div>

    {{-- Tabla --}}
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Listado de Usuarios</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th width="180">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td>{{ $user->id }}</td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>

                                    @if($user->role == 'ADMIN')

                                        <span class="badge bg-danger">
                                            Administrador
                                        </span>

                                    @elseif($user->role == 'OPERADOR')

                                        <span class="badge bg-warning text-dark">
                                            Operador
                                        </span>

                                    @else

                                        <span class="badge bg-info">
                                            Usuario
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($user->is_active)

                                        <span class="badge bg-success">
                                            Activo
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactivo
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('users.edit',$user->id) }}"
                                        class="btn btn-warning btn-sm">

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route('users.destroy',$user->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('¿Desea eliminar este usuario?')"
                                            class="btn btn-danger btn-sm">

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No existen usuarios registrados.

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