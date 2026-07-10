<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>

    <h1>Editar Usuario</h1>

    <table>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ $user->name }}"
                    required
                >
            </div>

            <div>
                <label for="email">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ $user->email }}"
                    required
                >
            </div>

            <div>
                <label for="password">Nueva Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Dejar en blanco para conservar la actual"
                >
            </div>

            <div>
                <label for="role">Rol</label>

                <select id="role" name="role" required>
                    <option value="ADMIN" {{ $user->role == 'ADMIN' ? 'selected' : '' }}>
                        Administrador
                    </option>

                    <option value="OPERADOR" {{ $user->role == 'OPERADOR' ? 'selected' : '' }}>
                        Operador
                    </option>

                    <option value="USER" {{ $user->role == 'USER' ? 'selected' : '' }}>
                        Usuario
                    </option>
                </select>
            </div>

            <div>
                <label for="is_active">Estado</label>

                <select id="is_active" name="is_active" required>
                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>
                        Activo
                    </option>

                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>
                        Inactivo
                    </option>
                </select>
            </div>

            <button type="submit">
                Guardar Cambios
            </button>

        </form>
    </table>

</body>
</html>