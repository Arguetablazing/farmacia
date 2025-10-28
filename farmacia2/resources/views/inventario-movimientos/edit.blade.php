@extends('layouts.app')

@section('content')
<h2>Editar Movimiento de Inventario</h2>

<form action="{{ route('inventario-movimientos.update', $inventario_movimiento->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Producto</label>
        <select name="id_producto" class="form-control" required>
            @foreach($productos as $producto)
            <option value="{{ $producto->id }}" {{ $inventario_movimiento->id_producto == $producto->id ? 'selected' : '' }}>
                {{ $producto->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tipo de Movimiento</label>
        <select name="tipo_movimiento" class="form-control" required>
            <option value="entrada" {{ $inventario_movimiento->tipo_movimiento == 'entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="salida" {{ $inventario_movimiento->tipo_movimiento == 'salida' ? 'selected' : '' }}>Salida</option>
            <option value="devolución" {{ $inventario_movimiento->tipo_movimiento == 'devolución' ? 'selected' : '' }}>Devolución</option>
            <option value="recepción" {{ $inventario_movimiento->tipo_movimiento == 'recepción' ? 'selected' : '' }}>Recepción</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $inventario_movimiento->cantidad) }}" required>
    </div>

    <div class="mb-3">
        <label>Motivo</label>
        <textarea name="motivo" class="form-control">{{ old('motivo', $inventario_movimiento->motivo) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Usuario</label>
        <select name="id_usuario" class="form-control">
            <option value="">N/A</option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $inventario_movimiento->id_usuario == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('inventario-movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
