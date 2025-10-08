@extends('layouts.app')

@section('content')
<h1>Crear Factura</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error) 
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('facturas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select id="id_cliente" name="id_cliente" class="form-select" required>
            <option value="">Selecciona cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_usuario" class="form-label">Usuario</label>
        <select id="id_usuario" name="id_usuario" class="form-select" required>
            <option value="">Selecciona usuario</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="total" class="form-label">Total</label>
        <input id="total" type="number" step="0.01" name="total" value="{{ old('total') }}" class="form-control" required min="0">
    </div>

    <div class="mb-3">
        <label for="enviada_por_correo" class="form-label">Enviada por correo</label>
        <select id="enviada_por_correo" name="enviada_por_correo" class="form-select" required>
            <option value="0" {{ old('enviada_por_correo') == '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('enviada_por_correo') == '1' ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <h3>Detalles</h3>
    <div id="detalles-container" class="mb-3">
        <div class="detalle-item d-flex gap-2 align-items-center mb-2">
            <select name="detalles[0][producto_id]" class="form-select" required style="width: 40%;">
                <option value="">Selecciona producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

            <input type="number" name="detalles[0][cantidad]" min="1" class="form-control" required placeholder="Cantidad" style="width: 20%;">

            <input type="number" step="0.01" name="detalles[0][precio_unitario]" min="0" class="form-control" required placeholder="Precio Unitario" style="width: 25%;">

            <button type="button" class="btn btn-danger btn-sm" onclick="removeDetalle(this)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        </div>
    </div>

    <button type="button" class="btn btn-primary mb-3" onclick="addDetalle()">
        <i class="bi bi-plus"></i> Agregar Detalle
    </button>

    <br>

    <button type="submit" class="btn btn-success">Guardar Factura</button>
</form>

<script>
    let detalleIndex = 1;

    function addDetalle() {
        const container = document.getElementById('detalles-container');
        const newDetalle = document.createElement('div');
        newDetalle.classList.add('detalle-item', 'd-flex', 'gap-2', 'align-items-center', 'mb-2');

        newDetalle.innerHTML = `
            <select name="detalles[${detalleIndex}][producto_id]" class="form-select" required style="width: 40%;">
                <option value="">Selecciona producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

            <input type="number" name="detalles[${detalleIndex}][cantidad]" min="1" class="form-control" required placeholder="Cantidad" style="width: 20%;">

            <input type="number" step="0.01" name="detalles[${detalleIndex}][precio_unitario]" min="0" class="form-control" required placeholder="Precio Unitario" style="width: 25%;">

            <button type="button" class="btn btn-danger btn-sm" onclick="removeDetalle(this)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        `;

        container.appendChild(newDetalle);
        detalleIndex++;
    }

    function removeDetalle(button) {
        button.parentElement.remove();
    }
</script>
@endsection
