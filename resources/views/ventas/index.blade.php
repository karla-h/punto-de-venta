@extends('layouts.plantilla')

@section('contenido')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center text-black">
        <h3 class="card-title"> Listado de Ventas</h3>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('ventas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>

            <form class="d-flex" method="GET">
                <input name="buscarpor" class="form-control me-2" type="search" placeholder="Buscar por descripción"
                    aria-label="Search" value="">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>  

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
                    <th scope="col">Fecha</th>
                    <th scope="col">RUC/DNI</th>
                    <th scope="col">Nombres/Razón</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($venta as $itemventa)
                    <tr>
                        <td>{{ $itemventa->venta_id }}</td>
                        <td>{{ $itemventa->tipo->descripcion }}</td>
                        <td>{{ $itemventa->fecha_venta }}</td>
                        <td>{{ $itemventa->cliente->ruc_dni }}</td>
                        <td>{{ $itemventa->cliente->nombres }}</td>
                        <td class="text-end">S/. {{ number_format($itemventa->total, 2) }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#detalleVenta"
                                onclick="loadModalContent('detalleVenta', '{{ route('ventas.show', $itemventa->venta_id) }}')">
                                <i class="fas fa-edit"></i> Detalle
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No se encontraron ventas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="detalleVenta" title="Detalle Venta" />

@endsection
