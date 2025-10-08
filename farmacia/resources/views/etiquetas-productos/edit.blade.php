@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Etiqueta de Producto</h1>

    <form action="{{ route('etiquetas-productos.update', $etiqueta->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Seleccionar Producto --}}
        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select name="id_producto" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $producto->id == $etiqueta->id_producto ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Código de barras --}}
        <div class="mb-3">
            <label for="codigo_barras" class="form-label">Código de Barras</label>
            <input type="text" name="codigo_barras" class="form-control" value="{{ $etiqueta->codigo_barras }}" required maxlength="50">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('etiquetas-productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
