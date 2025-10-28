@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Detalle de Facturas</h2>
    <a href="{{ route('detalle-factura.create') }}" class="btn btn-success">Nuevo Detalle</a>
</div>

{{-- Mostrar mensaje de éxito --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Factura</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if($detalles->isEmpty())
            <tr>
                <td colspan="6" class="text-center">No hay detalles registrados</td>
            </tr>
        @else
            @foreach($detalles as $detalle)
            <tr>
                <td>{{ $detalle->factura?->id ?? 'Sin factura' }}</td>
                <td>{{ $detalle->producto?->nombre ?? 'Producto no encontrado' }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>{{ number_format($detalle->subtotal, 2) }}</td>
                <td>
                    <a href="{{ route('detalle-factura.edit', $detalle->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('detalle-factura.destroy', $detalle->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar detalle?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
@endsection
