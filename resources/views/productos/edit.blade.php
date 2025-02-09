<form method="POST" action="{{ route('productos.update', $producto->idproducto) }}">
    @method('PUT')
    @csrf

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" maxlength="30"
            id="descripcion" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}">
        @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="idcategoria" class="form-label">Categorías:</label>
        <select class="form-select" id="idcategoria" name="idcategoria">
            @foreach ($categoria as $itemcategoria)
                <option value="{{ $itemcategoria->idcategoria }}" {{ $itemcategoria->idcategoria == $producto->idcategoria ? 'selected' : '' }}>
                    {{ $itemcategoria->descripcion }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="idtalla" class="form-label">Tallas:</label>
        <select class="form-select" id="idtalla" name="idtalla">
            @foreach ($talla as $itemtalla)
                <option value="{{ $itemtalla->idtalla }}" {{ $itemtalla->idtalla == $producto->idtalla ? 'selected' : '' }}>
                    {{ $itemtalla->descripcion }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio:</label>
        <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"
            value="{{ old('precio', $producto->precio) }}" style="text-align:right;">
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock:</label>
        <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
            value="{{ old('stock', $producto->stock) }}" style="text-align:right;">
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
    </div>
</form>
