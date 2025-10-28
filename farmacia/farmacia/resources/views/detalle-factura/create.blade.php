@extends('layouts.app')

@section('title', 'Agregar Detalle de Factura')

@section('content')
<div class="container mt-5">
    <h1 class="text-xl font-bold mb-4">Agregar Detalle de Factura</h1>

    <form action="{{ route('detalle-factura.store') }}" method="POST">
        @csrf

        <!-- Seleccionar Factura -->
        <div class="mb-4">
            <label for="id_factura" class="block">Factura:</label>
            <select name="id_factura" id="id_factura" required class="border px-3 py-2 w-full">
                <option value="">Seleccione una factura</option>
                @foreach ($facturas as $factura)
                    <option value="{{ $factura->id }}">
                        {{ $factura->id }} - {{ $factura->cliente->nombre ?? 'Sin cliente' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Seleccionar Producto -->
        <div class="mb-4">
            <label for="producto_id" class="block">Producto:</label>
            <select name="producto_id" id="producto_id" required class="border px-3 py-2 w-full">
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Cantidad -->
        <div class="mb-4">
            <label for="cantidad" class="block">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required class="border px-3 py-2 w-full" min="1">
        </div>

        <!-- Precio Unitario -->
        <div class="mb-4">
            <label for="precio_unitario" class="block">Precio Unitario:</label>
            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" required class="border px-3 py-2 w-full" min="0">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
