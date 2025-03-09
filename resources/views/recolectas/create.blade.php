@extends('layouts.master')


@section('content')
<br><br>
<center>
<div class="card" style="width: 40rem;">
    <div class="card-header">
      Registro de Recolección de Cosecha
    </div>
    <div class="card-body">
    
      <p class="card-text">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('recolectas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cultivo_id" class="form-label">Cultivo</label>
            <select name="cultivo_id" id="cultivo_id" class="form-control" required>
                <option value="">Seleccione un cultivo</option>
                @foreach($cultivos as $ruben)
                    <option value="{{ $ruben->id }}">{{ $ruben->nombre }} ({{ $ruben->tipo }}) </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_recolecta" class="form-label">Fecha de Recolección</label>
            <input type="date" name="fecha_recolecta" id="fecha_recolecta" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="unidad" class="form-label">Unidad (Kg, Toneladas, etc.)</label>
            <input type="text" name="unidad" id="unidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
@endsection
