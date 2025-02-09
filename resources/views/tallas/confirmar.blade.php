<div class="modal-body text-center">
    <h5 class="mb-2">¿Desea eliminar este registro?</h5>
    <div class="border rounded p-2 bg-light text-start">
        <p class="mb-1"><strong>Código:</strong> {{ $talla->idtalla }}</p>
        <p class="mb-1"><strong>Descripción:</strong> {{ $talla->descripcion }}</p>
    </div>
    <form method="POST" action="{{ route('tallas.destroy', $talla->idtalla) }}" class="mt-2">
        @method('delete')
        @csrf
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-check-square"></i> Sí, eliminar
            </button>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                <i class="fas fa-times-circle"></i> No, cancelar
            </button>
        </div>
    </form>
</div>
