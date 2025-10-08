@extends('layouts.app')

@section('content')
<h2>Crear Producto</h2>

<form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Categoría</label>
        <input type="text" name="categoria" class="form-control">
    </div>
    <div class="mb-3">
        <label>Proveedor</label>
        <input type="text" name="proveedor" class="form-control">
    </div>
    <div class="mb-3">
        <label>Precio Compra</label>
        <input type="number" step="0.01" name="precio_compra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Precio Venta</label>
        <input type="number" step="0.01" name="precio_venta" class="form-control">
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control">
    </div>
    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="1">Inactivo</option>
        </select>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
