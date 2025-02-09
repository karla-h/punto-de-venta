<form method="POST" action="{{ route('tallas.update', $talla->idtalla) }}">
    @method('PUT')
    @csrf

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" maxlength="30"
            id="descripcion" name="descripcion" value="{{ old('descripcion', $talla->descripcion) }}">
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
    </div>
</form>
