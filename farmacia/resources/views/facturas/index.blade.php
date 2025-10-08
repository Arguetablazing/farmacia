@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Facturas</h2>
    <a href="{{ route('facturas.create') }}" class="btn btn-success">Nueva Factura</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Enviada por correo</th>
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
            <td>{{ $factura->total }}</td>
            <td>{{ $factura->enviada_por_correo ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar factura?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
