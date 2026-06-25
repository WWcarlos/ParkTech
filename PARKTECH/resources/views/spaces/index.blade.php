<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <table>
        <thead>
            <th>Número de espacio</th>
            <th>Tipo de espacio</th>
            <th>estado</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($spaces as $space)
                <tr>
                    <td>{{$space->numero_space}}</td>
                    <td>{{$space->tipo_space}}</td>
                    <td>{{$space->estado}}</td>
                    <td>
                        <a href="{{route('spaces.edit', $space->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{route('spaces.destroy', $space->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            <form action="{{route('spaces.store')}}" method="post">
                @csrf
                <div>
                    <label for="numero_space">Numero de espacio</label>
                    <input type="text" id="numero_space" name="num_space">
                </div>
                <div>
                    <label for="tipo_space">Tipo de espacio</label>
                    <input type="text" id="tipo_space" name="tipo_space">
                </div>
                <div>
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </tbody>
    </table>
</body>
</html>