@extends('layouts.plantilla')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Listado de Categorías</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarCategoria"
                    onclick="loadModalContent('agregarCategoria', '{{ route('categorias.create') }}')">
                    <i class="fas fa-plus"></i> Nueva Categoría
                </button>
                <nav class="navbar navbar-light">
                    <form class="form-inline my-2 my-lg-0" method="GET">
                        <input name="buscarpor" class="form-control mr-sm-2" type="search"
                            placeholder="Buscar por descripción" aria-label="Search" value="{{ $buscarpor }}">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </nav>
            </div>

            <!-- Mensajes de sesión -->
            @if (session('datos'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('datos') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categoria as $itemcategoria)
                        <tr>
                            <td>{{ $itemcategoria->idcategoria }}</td>
                            <td>{{ $itemcategoria->descripcion }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#editarCategoria"
                                    onclick="loadModalContent('editarCategoria', '{{ route('categorias.edit', $itemcategoria->idcategoria) }}')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#eliminarCategoria"
                                    onclick="loadModalContent('eliminarCategoria', '{{ route('categorias.confirmar', $itemcategoria->idcategoria) }}')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No se encontraron categorías</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="agregarCategoria" title="Cargar Contenido" />
    <x-modal id="editarCategoria" title="Editar Categoría Contenido" />
    <x-modal id="eliminarCategoria" title="Confirmar Eliminación" />
@endsection
