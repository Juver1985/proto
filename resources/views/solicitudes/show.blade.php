@extends('layouts.mastermayordomo')

@section('content')
<div class="container">
    <h2>Detalles de la Solicitud</h2>
    
    <p><strong>Solicitante:</strong> {{ $solicitud->usuario->name }} ({{ ucfirst($solicitud->usuario->role) }})</p>
    <p><strong>Tipo de Solicitud:</strong> {{ $solicitud->tipo }}</p>
    <p><strong>Descripción:</strong> {{ $solicitud->descripcion }}</p>
    <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
    <p><strong>Fecha de Creación:</strong> {{ $solicitud->created_at->format('d/m/Y H:i') }}</p>

    <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Volver al Listado</a>
</div>
@endsection
