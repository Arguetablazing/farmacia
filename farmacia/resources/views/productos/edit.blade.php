@extends('layouts.app')

@section('content')
<h2>Editar Producto</h2>

<form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
    </div>
    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" value="{{ $producto->categoria }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Proveedor</label>
        <input type="text" name="proveedor" value="{{ $producto->proveedor }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Precio Compra</label>
        <input type="number" step="0.01" name="precio_compra" value="{{ $producto->precio_compra }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Precio Venta</label>
        <input type="number" step="0.01" name="precio_venta" value="{{ $producto->precio_venta }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" value="{{ $producto->stock }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="1" {{ $producto->estado ? 'selected':'' }}>Activo</option>
            <option value="0" {{ !$producto->estado ? 'selected':'' }}>Inactivo</option>
        </select>
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
