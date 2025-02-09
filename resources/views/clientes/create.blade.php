<form method="POST" action="{{ route('clientes.store') }}" class="p-4 border rounded shadow bg-light">
    @csrf

    <div class="mb-3">
        <label for="ruc_dni" class="form-label fw-bold">RUC/DNI:</label>
        <input type="text" class="form-control @error('ruc_dni') is-invalid @enderror"
            id="ruc_dni" name="ruc_dni" value="{{ old('ruc_dni') }}" placeholder="Ingrese el RUC o DNI del cliente">
        @error('ruc_dni')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nombres" class="form-label fw-bold">Nombre:</label>
        <input type="text" class="form-control @error('nombres') is-invalid @enderror"
            id="nombres" name="nombres" value="{{ old('nombres') }}" placeholder="Ingrese el nombre del cliente">
        @error('nombres')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-bold">Correo Electrónico:</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
            id="email" name="email" value="{{ old('email') }}" placeholder="Ingrese el correo electrónico del cliente">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="direccion" class="form-label fw-bold">Dirección:</label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror"
            id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Ingrese la dirección del cliente">
        @error('direccion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </div>
</form>
