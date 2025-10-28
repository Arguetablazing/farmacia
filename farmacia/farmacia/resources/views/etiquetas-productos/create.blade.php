@extends('layouts.app')

@section('content')
<div class="section-header light">
    <div class="section-header-content">
        <div class="section-icon">
            <i class="bi bi-tags"></i>
        </div>
        <div>
            <h2>Nueva etiqueta de producto</h2>
            <p>Genera códigos de barras modernos para facilitar el control de inventario.</p>
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
    <form action="{{ route('etiquetas-productos.store') }}" method="POST" class="row g-4">
        @csrf

        <div class="col-12">
            <label for="id_producto" class="form-label fw-semibold">Producto asociado</label>
            <select name="id_producto" id="id_producto" class="form-select" required>
                <option value="" disabled selected>Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('id_producto') == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Elige el producto al que se asociará la etiqueta.</div>
        </div>

        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-upc-scan fs-4"></i>
                    <div>
                        <div class="fw-semibold mb-1">El código de barras se generará automáticamente</div>
                        <p class="mb-0">Solo debes seleccionar el producto. Una vez guardado, podrás descargar o imprimir el código desde el listado.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex flex-wrap gap-3 justify-content-end">
            <button type="submit" class="btn btn-gradient-success btn-icon">
                <i class="bi bi-save2"></i>
                <span>Guardar etiqueta</span>
            </button>
            <a href="{{ route('etiquetas-productos.index') }}" class="btn btn-neutral btn-icon">
                <i class="bi bi-x-circle"></i>
                <span>Cancelar</span>
            </a>
        </div>
    </form>
</div>
@endsection
