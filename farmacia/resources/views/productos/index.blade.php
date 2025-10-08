@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Nuevo Producto</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Proveedor</th>
            <th>Precio Venta</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>{{ $producto->categoria }}</td>
            <td>{{ $producto->proveedor }}</td>
            <td>{{ $producto->precio_venta }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
            <td>
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
