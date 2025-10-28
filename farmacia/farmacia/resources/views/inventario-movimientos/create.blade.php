@extends('layouts.app')

@section('content')
<h2>Nuevo Movimiento de Inventario</h2>

<form action="{{ route('inventario-movimientos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Producto</label>
        <select name="id_producto" class="form-control" required>
            @foreach($productos as $producto)
            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tipo de Movimiento</label>
        <select name="tipo_movimiento" class="form-control" required>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
            <option value="devolución">Devolución</option>
            <option value="recepción">Recepción</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Motivo</label>
        <textarea name="motivo" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Usuario</label>
        <select name="id_usuario" class="form-control">
            <option value="">N/A</option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('inventario-movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
