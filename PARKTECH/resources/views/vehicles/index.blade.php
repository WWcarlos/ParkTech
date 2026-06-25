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
            <th>Placa</th>
            <th>Tipo de vehiculo</th>
            <th>marca</th>
            <th>color</th>
            <th>propietario</th>
            <th>telefono</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->placa}}</td>
                    <td>{{$vehicle->tipo_vehiculo}}</td>
                    <td>{{$vehicle->marca}}</td>
                    <td>{{$vehicle->color}}</td>
                    <td>{{$vehicle->propietario}}</td>
                    <td>{{$vehicle->telefono}}</td>
                    <td>
                        <a href="{{route('vehicles.edit', $vehicle->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{route('vehicles.destroy', $vehicle->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            <form action="{{route('vehicles.store')}}" method="post">
                @csrf
                <div>
                    <label for="placa">Placa</label>
                    <input type="text" id="placa" name="placa">
                </div>
                <div>
                    <label for="tipo_vehiculo">Tipo de vehiculo</label>
                    <input type="text" id="tipo_vehiculo" name="tipo_vehiculo">
                </div>
                <div>
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca">
                </div>                
                <div>
                    <label for="color">Color</label>
                    <input type="text" id="color" name="color">
                </div>
                <div>
                    <label for="propietario">Propietario</label>
                    <input type="text" id="propietario" name="propietario">
                </div>
                <div>
                    <label for="telefono">Telefono</label>
                    <input type="text" id="telefono" name="telefono">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </tbody>
    </table>
</body>
</html>