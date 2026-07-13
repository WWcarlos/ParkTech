<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Editar Registro</h3>

</div>

<div class="card-body">

<form action="{{ route('parking-records.update',$parkingRecord->id) }}" method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-4">

<label>Vehículo</label>

<select class="form-control" name="vehicle_id">

@foreach($vehicles as $vehicle)

<option
value="{{ $vehicle->id }}"
{{ $parkingRecord->vehicle_id == $vehicle->id ? 'selected' : '' }}>

{{ $vehicle->plate }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Usuario</label>

<select class="form-control" name="user_id">

@foreach($users as $user)

<option
value="{{ $user->id }}"
{{ $parkingRecord->user_id == $user->id ? 'selected' : '' }}>

{{ $user->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Espacio</label>

<select class="form-control" name="space_id">

@foreach($spaces as $space)

<option
value="{{ $space->id }}"
{{ $parkingRecord->space_id == $space->id ? 'selected' : '' }}>

{{ $space->space_number }}

</option>

@endforeach

</select>

</div>

</div>

<div class="row mt-3">

<div class="col-md-4">

<label>Entrada</label>

<input
type="datetime-local"
class="form-control"
name="entry_time"
value="{{ date('Y-m-d\TH:i',strtotime($parkingRecord->entry_time)) }}">

</div>

<div class="col-md-4">

<label>Salida</label>

<input
type="datetime-local"
class="form-control"
name="exit_time"
value="{{ $parkingRecord->exit_time ? date('Y-m-d\TH:i',strtotime($parkingRecord->exit_time)) : '' }}">

</div>

<div class="col-md-4">

<label>Estado</label>

<select
name="status"
class="form-control">

<option
value="ACTIVE"
{{ $parkingRecord->status=='ACTIVE' ? 'selected' : '' }}>

ACTIVE

</option>

<option
value="COMPLETED"
{{ $parkingRecord->status=='COMPLETED' ? 'selected' : '' }}>

COMPLETED

</option>

</select>

</div>

</div>

<div class="row mt-3">

<div class="col-md-4">

<label>Total</label>

<input
type="number"
step="0.01"
class="form-control"
name="total_amount"
value="{{ $parkingRecord->total_amount }}">

</div>

</div>

<div class="mt-4">

<button class="btn btn-success">

Actualizar

</button>

<a href="{{ route('parking-records.index') }}" class="btn btn-secondary">

Volver

</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html> 