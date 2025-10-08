@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Facturas</h2>
        <a href="{{ route('facturas.create') }}" class="btn btn-success">Nueva Factura</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Enviada por correo</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>{{ $factura->id }}</td>
                <td>{{ $factura->cliente->nombre }}</td>
                <td>{{ $factura->usuario->nombre }}</td>
                <td>{{ $factura->fecha }}</td>
                <td>{{ number_format($factura->total, 2) }}</td>
                <td>{{ $factura->enviada_por_correo ? 'Sí' : 'No' }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach($factura->detalles as $detalle)
                            <li>
                                {{ $detalle->producto->nombre }} — 
                                Cantidad: {{ $detalle->cantidad }}, 
                                Precio: {{ number_format($detalle->precio_unitario, 2) }}, 
                                Subtotal: {{ number_format($detalle->subtotal, 2) }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-primary btn-sm me-1">Editar</a>
                    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar factura?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($facturas->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No hay facturas registradas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
