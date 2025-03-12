@extends('layouts.master')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Herramientas</title>
</head>
<body>
    <center><h1>Listado de Herramientas</h1>
    <br>
    <div class="card" style="width: 70rem">
        <div class="card-body">
            <div class="row">
            </div>
        </div>
        <div class="table table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <th><center>ID</center></th>
                    <th><center>Fecha Registro</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Marca</center></th>
                    <th><center>Tipo</center></th>
                    <th><center>Valor Unitario</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Estado</center></th>
                   
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    @foreach ($herramientas as $herramienta)
                    <tr>
                        <td><center>{{ $herramienta->id }}</center></td>
                        <td><center>{{ $herramienta->fecha_registro }}</center></td>
                        <td><center>{{ $herramienta->nombre }}</center></td>
                        <td><center>{{ $herramienta->marca }}</center></td>
                        <td><center>{{ $herramienta->tipo }}</center></td>
                        <td><center>{{ $herramienta->valor_unitario }}</center></td>
                        <td><center>{{ $herramienta->cantidad }}</center></td>
                        <td><center>{{ $herramienta->estado }}</center></td>
                       
                       
                        <td>
                            <center>
                                <button type="button" class="btn btn-success editbtn" 
                                    data-id="{{ $herramienta->id }}" 
                                    data-nombre="{{ $herramienta->fecha_registro }}"
                                    data-nombre="{{ $herramienta->nombre }}" 
                                    data-marca="{{ $herramienta->marca }}"
                                    data-tipo="{{ $herramienta->tipo }}" 
                                    data-valor_unitario="{{ $herramienta->valor_unitario }}"
                                    data-cantidad="{{ $herramienta->cantidad }}" 
                                    data-estado="{{ $herramienta->estado }}"
                                    
                                    data-bs-toggle="modal" data-bs-target="#editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </center>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-danger deletebtn" data-id="{{ $herramienta->id }}"
                                    data-bs-toggle="modal" data-bs-target="#eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </center>

    <!-- Modal de Edición -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditar" action="{{ route('herramientas.update', 0) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarLabel">Editar Herramienta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-fecha_registro" class="form-label">Fecha Registro</label>
                            <input type="date" class="form-control" id="edit-fecha_registro" name="fecha_registro">
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
                            <label for="edit-valor_unitario" class="form-label">Precion Unidad</label>
                            <input type="number" class="form-control" id="edit-valor_unitario" name="valor_unitario">
                        </div>
                        <div class="mb-3">
                            <label for="edit-cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="edit-cantidad" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="edit-estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="edit-estado" name="estado">
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

    <!-- Modal de Eliminación -->
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
                        <p>¿Está seguro de que desea eliminar esta herramienta?</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEditar').action = `/herramientas/${id}`;
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-fecha_registro').value = this.getAttribute('data-fecha_registro');
                    document.getElementById('edit-nombre').value = this.getAttribute('data-nombre');
                    document.getElementById('edit-marca').value = this.getAttribute('data-marca');
                    document.getElementById('edit-tipo').value = this.getAttribute('data-tipo');
                    document.getElementById('edit-valor_unitario').value = this.getAttribute('data-valor_unitario');
                    document.getElementById('edit-cantidad').value = this.getAttribute('data-cantidad');
                    document.getElementById('edit-estado').value = this.getAttribute('data-estado');
                  
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/herramientas/${id}`;
                });
            });
        });
    </script>
</body>
</html>
@endsection
