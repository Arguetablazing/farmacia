<!-- resources/views/etiquetas_productos/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Etiquetas de Productos</h1>
    <a href="{{ route('etiquetas-productos.create') }}" class="btn btn-primary mb-3">Nueva Etiqueta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Código de Barras</th>
                <th>Fecha Generada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etiquetas as $etiqueta)
            <tr>
                <td>{{ $etiqueta->id }}</td>
                <td>{{ $etiqueta->producto->nombre ?? 'N/A' }}</td>
                <td>{{ $etiqueta->codigo_barras }}</td>
                <td>{{ $etiqueta->fecha_generada }}</td>
                <td>
                    <a href="{{ route('etiquetas-productos.edit', $etiqueta->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('etiquetas-productos.destroy', $etiqueta->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar etiqueta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
