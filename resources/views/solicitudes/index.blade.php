@extends('layouts.mastermayordomo')

@section('content')
<div class="container">
    <h2>Listado de Solicitudes</h2>

    {{-- Filtro de búsqueda --}}
    <form action="{{ route('solicitudes.index') }}" method="GET" class="mb-3 d-flex gap-2">
        <select name="tipo" class="form-control w-25">
            <option value="">Filtrar por Tipo</option>
            <option value="Herramienta">Herramienta</option>
            <option value="Insumo">Insumo</option>
            <option value="Actividad">Actividad</option>
            <option value="Otro">Otro</option>
        </select>

        <select name="estado" class="form-control w-25">
            <option value="">Filtrar por Estado</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Aprobada">Aprobada</option>
            <option value="Rechazada">Rechazada</option>
        </select>

        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    {{-- Tabla de Solicitudes --}}
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Destinatario</th>
                <th>Rol</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->usuario->name }}</td>
                    <td>{{ ucfirst($solicitud->usuario->role) }}</td>
                    <td>{{ $solicitud->tipo }}</td>
                    <td>{{ $solicitud->descripcion }}</td>
                    <td>
                        @if($solicitud->estado == 'Pendiente')
                            <span class="badge bg-warning text-dark">{{ $solicitud->estado }}</span>
                        @elseif($solicitud->estado == 'Aprobada')
                            <span class="badge bg-success">{{ $solicitud->estado }}</span>
                        @else
                            <span class="badge bg-danger">{{ $solicitud->estado }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $solicitudes->links() }}
    </div>
</div>
@endsection
