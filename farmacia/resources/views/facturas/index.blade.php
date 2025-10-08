@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Facturas</h2>
    <a href="{{ route('facturas.create') }}" class="btn btn-success">Nueva Factura</a>
</div>

<table class="table table-bordered table-striped table-hover align-middle">
    <thead class="table-dark">
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
        @forelse($facturas as $factura)
            <tr>
                <td>{{ $factura->id }}</td>
                <td>{{ $factura->cliente->nombre }}</td>
                <td>{{ $factura->usuario->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                <td>${{ number_format($factura->total, 2) }}</td>
                <td>{{ $factura->enviada_por_correo ? 'Sí' : 'No' }}</td>
                <td class="p-0">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factura->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td>
                    <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-primary btn-sm mb-1 w-100">Editar</a>
                    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" onsubmit="return confirm('¿Eliminar factura?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center fst-italic">No hay facturas registradas.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
