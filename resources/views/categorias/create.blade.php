<form method="POST" action="{{ route('categorias.store') }}" class="p-4 border rounded shadow bg-light">
    @csrf

    <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripción:</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
            id="descripcion" name="descripcion" value="{{ old('descripcion') }}" placeholder="Ingrese la categoría">
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        <a href="{{ route('cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </div>
</form>
