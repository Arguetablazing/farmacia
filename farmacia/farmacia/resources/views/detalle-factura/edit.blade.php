<form action="{{ route('detalle-factura.update', $detalle->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="id_factura">Factura</label>
        <select name="id_factura" id="id_factura" class="form-control" required>
            @foreach ($facturas as $factura)
                <option value="{{ $factura->id }}" {{ $detalle->id_factura == $factura->id ? 'selected' : '' }}>
                    {{ $factura->id }} - {{ $factura->cliente->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_producto">Producto</label>
        <select name="id_producto" id="id_producto" class="form-control" required>
            @foreach ($productos as $producto)
                <option value="{{ $producto->id }}" {{ $detalle->id_producto == $producto->id ? 'selected' : '' }}>
                    {{ $producto->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $detalle->cantidad }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Detalle</button>
</form>
