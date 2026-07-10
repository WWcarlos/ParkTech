<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
</head>
<body>

    <h1>Gestión de Usuarios</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if($user->is_active)
                            Activo
                        @else
                            Inactivo
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <hr>

    <h2>Registrar Usuario</h2>

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div>
            <label for="name">Nombre</label>
            <input
                type="text"
                id="name"
                name="name"
                required
            >
        </div>

        <div>
            <label for="email">Correo Electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                required
            >
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <div>
            <label for="role">Rol</label>

            <select id="role" name="role" required>
                <option value="">Seleccione...</option>
                <option value="ADMIN">Administrador</option>
                <option value="OPERADOR">Operador</option>
                <option value="USER">Usuario</option>
            </select>
        </div>

        <div>
            <label for="is_active">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    checked
                >
                Usuario Activo
            </label>
        </div>

        <button type="submit">
            Guardar Usuario
        </button>

    </form>

</body>
</html>