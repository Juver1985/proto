@extends('layouts.master')

@section('content')
<br><br>
<center>
<div class="card" style="width: 40rem;">
    <div class="card-header">
      Registro de Finca
    </div>
    <div class="card-body">
    
      <p class="card-text">
    <form action="{{ route('fincas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Finca</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" class="form-control" name="latitud" required>
        </div>
        <div class="mb-3">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" class="form-control" name="longitud" required>
        </div>
        <button type="submit" class="btn btn-danger">Mapear</button>
    </form>
</div>
@endsection
