@extends('layouts.plantilla')

@section('contenido')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3><i class="fas fa-file-invoice-dollar"></i> Registrar Venta</h3>
            </div>
            <div class="card-body">
                <div class="alert hidden" role="alert"></div>
                <form action="{{ route('ventas.store') }}" method="POST" class="p-3">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <div class="input-group date" data-target="#fecha" data-toggle="datetimepicker">
                                <input type="text" id="fecha" name="fecha" class="form-control datetimepicker-input"
                                    value="{{ Carbon\Carbon::now()->format('d/m/Y') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="seltipo" class="form-label">Tipo</label>
                            <select class="form-select" id="seltipo" name="seltipo" onchange="mostrarTipo()">
                                @foreach ($tipo as $itemtipo)
                                    <option value="{{ $itemtipo['tipo_id'] }}">{{ $itemtipo['descripcion'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="nrodoc" class="form-label">No Doc.</label>
                            <input type="text" class="form-control" name="nrodoc" id="nrodoc"
                                value="{{ $parametros->serie . $parametros->numeracion }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-select select2" id="cliente_id" name="cliente_id">
                                <option value="0" selected>- Seleccione Cliente -</option>
                                @foreach ($cliente as $itemcliente)
                                    <option value="{{ $itemcliente->cliente_id }}_{{ $itemcliente->ruc_dni }}_{{ $itemcliente->direccion }}">
                                        {{ $itemcliente->nombres }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="ruc" class="form-label">RUC/DNI</label>
                            <input type="text" class="form-control" name="ruc" id="ruc" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" readonly>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="idproducto" class="form-label">Producto</label>
                            <select class="form-select select2" id="idproducto" name="idproducto">
                                <option value="0" selected>- Seleccione Producto -</option>
                                @foreach ($producto as $itemproducto)
                                    <option value="{{ $itemproducto->idproducto }}">{{ $itemproducto->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="talla" class="form-label">Talla</label>
                            <input type="text" class="form-control" name="talla" id="talla" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control" name="precio" id="precio" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" step="1" min="1" value="1" class="form-control" name="cantidad" id="cantidad">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" id="btnadddet" class="btn btn-success w-100">
                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive mb-3">
                        <table id="detalles" class="table table-bordered text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                    <th>P. Venta</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9 text-end">
                            <label for="total" class="form-label fw-bold">Total:</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control text-end" name="total" id="total" readonly>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary me-2" type="submit" id="btnRegistrar">
                            <i class='fas fa-save'></i> Registrar
                        </button>
                        <a href="{{ URL::to('venta') }}" class='btn btn-danger'>
                            <i class='fas fa-ban'></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/archivos/js/createdoc.js"></script>
    <script>
        $(document).ready(function() {
            $('#fecha').datetimepicker({ format: 'DD/MM/YYYY' });
        });
    </script>
@endsection

