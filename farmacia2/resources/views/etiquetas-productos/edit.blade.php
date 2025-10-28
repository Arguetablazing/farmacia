@extends('layouts.app')

@section('content')
<div class="section-header light">
    <div class="section-header-content">
        <div class="section-icon">
            <i class="bi bi-pencil-square"></i>
        </div>
        <div>
            <h2>Editar etiqueta de producto</h2>
            <p>Actualiza los datos de la etiqueta para mantener la información al día.</p>
        </div>
    </div>
    <div class="section-actions">
        <a href="{{ route('etiquetas-productos.index') }}" class="btn btn-neutral btn-icon">
            <i class="bi bi-arrow-left"></i>
            <span>Volver al listado</span>
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mt-4" role="alert">
        <div class="d-flex align-items-start gap-3">
            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
            <div>
                <div class="fw-semibold mb-1">Por favor revisa los datos ingresados</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="card-surface form-card mt-4">
    <form action="{{ route('etiquetas-productos.update', $etiqueta->id) }}" method="POST" class="row g-4">
        @csrf
        @method('PUT')

        <div class="col-12">
            <label for="id_producto" class="form-label fw-semibold">Producto asociado</label>
            <select name="id_producto" id="id_producto" class="form-select" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('id_producto', $etiqueta->id_producto) == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Selecciona el producto al que pertenece esta etiqueta.</div>
        </div>

        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-upc-scan fs-4"></i>
                    <div>
                        <div class="fw-semibold mb-1">El código de barras se genera automáticamente</div>
                        <p class="mb-0">Solo puedes actualizar el producto asociado. El código se regenera durante la creación inicial.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex flex-wrap gap-3 justify-content-end">
            <button type="submit" class="btn btn-gradient-primary btn-icon">
                <i class="bi bi-save"></i>
                <span>Actualizar etiqueta</span>
            </button>
            <a href="{{ route('etiquetas-productos.index') }}" class="btn btn-neutral btn-icon">
                <i class="bi bi-x-circle"></i>
                <span>Cancelar</span>
            </a>
        </div>
    </form>
</div>
@endsection
