<div class="modal-body text-center">
    <h5 class="mb-2">Detalle de Venta</h5>

    <div class="border rounded p-3 bg-light text-start">
        <p class="mb-1"><strong>Código de Venta:</strong> {{ $venta->venta_id }}</p>
        <p class="mb-1"><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
        <p class="mb-1"><strong>Cliente:</strong> {{ $venta->cliente->nombres }}</p>
        <p class="mb-1"><strong>RUC/DNI:</strong> {{ $venta->cliente->ruc_dni }}</p>
        <p class="mb-1"><strong>Total:</strong> S/. {{ number_format($venta->total, 2) }}</p>
    </div>

    <h6 class="mt-3 text-muted"><i class="fas fa-box"></i> Productos Vendidos</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($venta->detalleventas as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>S/. {{ number_format($detalle->precio, 2) }}</td>
                        <td>S/. {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay productos en esta venta</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center gap-2 mt-3">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
            <i class="fas fa-times-circle"></i> Cerrar
        </button>
        <button type="button" class="btn btn-success btn-sm">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>
</div>
