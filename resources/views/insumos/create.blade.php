@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white text-center">
            <h3><i class="fas fa-box"></i> Registrar Insumo</h3>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('insumos.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Registro</label>
                        <input type="date" name="fecha_registro" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-tag"></i> Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Fertilizante" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-industry"></i> Marca</label>
                        <input type="text" name="marca" class="form-control" placeholder="Ej: Bayer" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-cube"></i> Tipo</label>
                        <input type="text" name="tipo" class="form-control" placeholder="Ej: Orgánico" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-dollar-sign"></i> Valor Unitario</label>
                        <input type="number" name="valor_unitario" step="0.01" class="form-control" placeholder="Ej: 15000" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-boxes"></i> Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" placeholder="Ej: 10" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-check-circle"></i> Disponible</label>
                        <select name="disponible" class="form-select" required>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Registrar Insumo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
