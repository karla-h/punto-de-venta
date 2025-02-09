<div class="modal-body text-center">
    <h5 class="mb-2">¿Desea eliminar este registro?</h5>
    <div class="border rounded p-2 bg-light text-start">
        <p class="mb-1"><strong>Código:</strong> {{ $cliente->cliente_id }}</p>
        <p class="mb-1"><strong>RUC/DNI:</strong> {{ $cliente->ruc_dni }}</p>
        <p class="mb-1"><strong>Nombre:</strong> {{ $cliente->nombres }}</p>
        <p class="mb-1"><strong>Correo Electrónico:</strong> {{ $cliente->email }}</p>
        <p class="mb-1"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
    </div>
    <form method="POST" action="{{ route('clientes.destroy', $cliente->cliente_id) }}" class="mt-2">
        @method('delete')
        @csrf
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-check-square"></i> Sí, eliminar</button>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> No, cancelar</button>
        </div>
    </form>
</div>
