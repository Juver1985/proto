@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Registro de Herramientas</h2>
    <form action="{{ route('herramientas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Fecha de Registro</label>
            <input type="date" name="fecha_registro" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Valor Unitario</label>
            <input type="number" name="valor_unitario" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Disponible</label>
            <select name="disponible" class="form-control" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection
