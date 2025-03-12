@extends('layouts.mastermayordomo')

@section('content')
    <div class="container">
        <h2>Editar Solicitud</h2>
        <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Solicitud</label>
                <select name="tipo" class="form-control" required>
                    <option value="Herramienta" {{ $solicitud->tipo == 'Herramienta' ? 'selected' : '' }}>Herramienta</option>
                    <option value="Insumo" {{ $solicitud->tipo == 'Insumo' ? 'selected' : '' }}>Insumo</option>
                    <option value="Otro" {{ $solicitud->tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required>{{ $solicitud->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Pendiente" {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Aprobada" {{ $solicitud->estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="Rechazada" {{ $solicitud->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
