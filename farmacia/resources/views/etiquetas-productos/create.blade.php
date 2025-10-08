@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Etiqueta de Producto</h1>

    <form action="{{ route('etiquetas-productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select name="id_producto" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="codigo_barras" class="form-label">Código de Barras</label>
            <input type="text" name="codigo_barras" class="form-control" required maxlength="50">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('etiquetas-productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
