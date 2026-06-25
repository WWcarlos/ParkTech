<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <form action="{{route('vehicles.update', $vehicle->id)}}" method="post">
            @csrf
            @method('put')
                <div>
                    <label for="placa">Placa</label>
                    <input type="text" id="placa" name="placa" value="{{$vehicle->placa}}">
                </div>
                <div>
                    <label for="tipo_vehiculo">Tipo de vehiculo</label>
                    <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" value="{{$vehicle->tipo_vehiculo}}">
                </div>
                <div>
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" value="{{$vehicle->marca}}">
                </div>                
                <div>
                    <label for="color">Color</label>
                    <input type="text" id="color" name="color" value="{{$vehicle->color}}">
                </div>
                <div>
                    <label for="propietario">Propietario</label>
                    <input type="text" id="propietario" name="propietario" value="{{$vehicle->propietario}}">
                </div>
                <div>
                    <label for="telefono">Telefono</label>
                    <input type="text" id="telefono" name="telefono" value="{{$vehicle->telefono}}">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>        
        </form>
    </table>
</body>
</html>