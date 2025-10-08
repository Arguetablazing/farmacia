@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Movimientos de Inventario</h2>
    <a href="{{ route('inventario-movimientos.create') }}" class="btn btn-success">Nuevo Movimiento</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimientos as $movimiento)
        <tr>
            <td>{{ $movimiento->id }}</td>
            <td>{{ $movimiento->producto->nombre }}</td>
            <td>{{ ucfirst($movimiento->tipo_movimiento) }}</td>
            <td>{{ $movimiento->cantidad }}</td>
            <td>{{ $movimiento->motivo }}</td>
            <td>{{ $movimiento->fecha }}</td>
            <td>{{ $movimiento->usuario? $movimiento->usuario->nombre : 'N/A' }}</td>
            <td>
                <a href="{{ route('inventario-movimientos.edit', $movimiento->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('inventario-movimientos.destroy', $movimiento->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar movimiento?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
