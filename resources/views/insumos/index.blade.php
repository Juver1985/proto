@extends('layouts.master')

@section('content')

    <center><h1>Listado de Insumos</h1>
    <br>
    <div class="card" style="width: 70rem">
        <div class="card-body">
            <div class="row"></div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Id</th>
                        <th>Fecha Registro</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Cantidad</th>     
                        <th>Disponible</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insumos as $insumo)
                    <tr class="text-center">
                        <td>{{ $insumo->id }}</td>
                        <td>{{ $insumo->fecha_registro }}</td>
                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->marca }}</td>
                        <td>{{ $insumo->tipo }}</td>
                        <td>{{ $insumo->valor_unitario }}</td>
                        <td>{{ $insumo->cantidad }}</td>
                        <td>{{ $insumo->disponible }}</td>
                        <td>
                            <button type="button" class="btn btn-success editbtn" 
                                data-id="{{ $insumo->id }}" data-fecha_registro="{{ $insumo->fecha_registro }}" 
                                data-nombre="{{ $insumo->nombre }}" data-marca="{{ $insumo->marca }}" 
                                data-tipo="{{ $insumo->tipo }}"       data-valor_unitario="{{ $insumo->valor_unitario }}" 
                                data-cantidad="{{ $insumo->cantidad }}" 
                                data-disponible="{{ $insumo->disponible }}"
                                data-bs-toggle="modal" data-bs-target="#editar">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger deletebtn" 
                                data-id="{{ $insumo->id }}" data-bs-toggle="modal" data-bs-target="#eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Editar -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditar" action="{{ route('insumos.update', $insumo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarLabel">Editar Insumo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-fecha" class="form-label">Fecha Registro</label>
                            <input type="date" class="form-control" id="edit-fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="edit-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="edit-marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="edit-marca" name="marca">
                        </div>
                        <div class="mb-3">
                            <label for="edit-tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="edit-tipo" name="tipo">
                        </div>
                        <div class="mb-3">
                            <label for="edit-valor_unitario" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="edit-valor_unitario" name="precio">
                        </div>
                        <div class="mb-3">
                            <label for="edit-cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="edit-cantidad" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="edit-disponible" class="form-label">Disponible</label>
                            <select class="form-select" id="edit-disponible" name="disponible">
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarLabel">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar este insumo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    document.getElementById('formEditar').action = `/insumos/${id}`;
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-fecha').value = this.dataset.fecha_registro;
                    document.getElementById('edit-nombre').value = this.dataset.nombre;
                    document.getElementById('edit-marca').value = this.dataset.marca;
                    document.getElementById('edit-tipo').value = this.dataset.tipo;
                    document.getElementById('edit-valor_unitario').value = this.dataset.precio;
                    document.getElementById('edit-cantidad').value = this.dataset.cantidad;
                    document.getElementById('edit-disponible').value = this.dataset.disponible;
                });
            });

            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    document.getElementById('formEliminar').action = `/insumos/${id}`;
                });
            });
        });
    </script>

@endsection
</center>