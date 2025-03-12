@extends('layouts.mastermayordomo')

@section('content')
    <div class="container">
        <h2>Nueva Solicitud</h2>
        <form action="{{ route('solicitudes.store') }}" method="POST">
    @csrf

    <label for="usuario_id">Seleccionar Usuario:</label>
    <select name="usuario_id" id="usuario_id" class="form-control" required>
        <option value="">Seleccione un usuario</option>
        @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->name }} - {{ ucfirst($usuario->role) }}</option>
        @endforeach
    </select>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Solicitud</label>
        <select name="tipo" class="form-control" required>
            <option value="">Seleccione Solicitud</option>
            <option value="Herramienta">Herramienta</option>
            <option value="Insumo">Insumo</option>
            <option value="Actividad">Actividad</option>
            <option value="Otro">Otro</option>
        </select>
    </div>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" class="form-control" required></textarea><br>

    <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
</form>
    </div>
@endsection
