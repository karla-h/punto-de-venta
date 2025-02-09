@extends('layouts.plantilla')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Listado de Productos</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarProducto"
                    onclick="loadModalContent('agregarProducto', '{{ route('productos.create') }}')">
                    <i class="fas fa-plus"></i> Nuevo Producto
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
                        <th scope="col">Categoría</th>
                        <th scope="col">Talla</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($producto as $itemproducto)
                        <tr>
                            <td>{{ $itemproducto->idproducto }}</td>
                            <td>{{ $itemproducto->descripcion }}</td>
                            <td>{{ $itemproducto->categoria }}</td>
                            <td>{{ $itemproducto->talla }}</td>
                            <td>{{ $itemproducto->precio }}</td>
                            <td>{{ $itemproducto->stock }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#editarProducto"
                                    onclick="loadModalContent('editarProducto', '{{ route('productos.edit', $itemproducto->idproducto) }}')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#eliminarProducto"
                                    onclick="loadModalContent('eliminarProducto', '{{ route('productos.confirmar', $itemproducto->idproducto) }}')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No se encontraron productos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="agregarProducto" title="Cargar Contenido" />
    <x-modal id="editarProducto" title="Editar Producto Contenido" />
    <x-modal id="eliminarProducto" title="Confirmar Eliminación" />
@endsection
