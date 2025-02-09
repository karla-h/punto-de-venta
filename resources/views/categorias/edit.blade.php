<form method="POST" action="{{ route('categorias.update', $categoria->idcategoria) }}" >
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="id" class="form-label fw-bold">Código:</label>
        <input type="text" class="form-control" id="id" name="id"
            value="{{ $categoria->idcategoria }}" disabled>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripción:</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
            id="descripcion" name="descripcion" value="{{ old('descripcion', $categoria->descripcion) }}"
            placeholder="Ingrese la nueva descripción">
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        <a href="{{ route('cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </div>
</form>
