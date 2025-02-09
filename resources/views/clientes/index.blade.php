@extends('layouts.plantilla')
@section('contenido')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Listado de Clientes</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarCliente"
                    onclick="loadModalContent('agregarCliente', '{{ route('clientes.create') }}')">
                    <i class="fas fa-plus"></i> Nuevo Cliente
                </button>
                <nav class="navbar navbar-light">
                    <form class="form-inline my-2 my-lg-0" method="GET">
                        <input name="buscarpor" class="form-control mr-sm-2" type="search"
                            placeholder="Buscar por nombre, RUC/DNI o email" aria-label="Search" value="{{ $buscarpor }}">
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
                        <th scope="col">RUC/DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cliente_id }}</td>
                            <td>{{ $cliente->ruc_dni }}</td>
                            <td>{{ $cliente->nombres }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#editarCliente"
                                    onclick="loadModalContent('editarCliente', '{{ route('clientes.edit', $cliente->cliente_id) }}')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#eliminarCliente"
                                    onclick="loadModalContent('eliminarCliente', '{{ route('clientes.confirmar', $cliente->cliente_id) }}')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron clientes</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="agregarCliente" title="Cargar Contenido" />
    <x-modal id="editarCliente" title="Editar Cliente Contenido" />
    <x-modal id="eliminarCliente" title="Confirmar Eliminación" />
@endsection
