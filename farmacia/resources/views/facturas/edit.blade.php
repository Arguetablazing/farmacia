@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Detalle de Factura</h2>

    <form action="{{ route('detalle-factura.update', $detalle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_factura" class="form-label">Factura (ID)</label>
            <select name="id_factura" class="form-select" required>
                @foreach($facturas as $factura)
                    <option value="{{ $factura->id }}" {{ $factura->id == $detalle->id_factura ? 'selected' : '' }}>
                        {{ $factura->id }} - {{ $factura->cliente->nombre ?? 'Sin cliente' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto (ID)</label>
            <select name="id_producto" class="form-select" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $producto->id == $detalle->id_producto ? 'selected' : '' }}>
                        {{ $producto->id }} - {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $detalle->cantidad }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control" value="{{ $detalle->precio_unitario }}" required min="0">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('detalle-factura.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
