<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <form action="{{route('spaces.update', $space->id)}}" method="post">
            @csrf
            @method('put')
                <div>
                    <label for="numero_space">Numero de espacio</label>
                    <input type="text" id="numero_space" name="num_space" value="{{$space->numero_space}}">
                </div>
                <div>
                    <label for="tipo_space">Tipo de espacio</label>
                    <input type="text" id="tipo_space" name="tipo_space" value="{{$space->tipo_space}}">
                </div>
                <div>
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" value="{{$space->estado}}">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Guardar Cambios</button>        
        </form>
    </table>
</body>
</html>