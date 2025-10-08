@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Factura</h1>

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf

        {{-- Seleccionar Cliente --}}
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <select name="id_cliente" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Seleccionar Usuario --}}
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Total --}}
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" class="form-control" step="0.01" required>
        </div>

        {{-- Enviada por correo --}}
        <div class="mb-3">
            <label for="enviada_por_correo" class="form-label">Enviada por correo</label>
            <select name="enviada_por_correo" class="form-control" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Factura</button>
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
