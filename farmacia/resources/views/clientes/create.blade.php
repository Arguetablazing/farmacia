@extends('layouts.app')

@section('content')
<h2>Crear Cliente</h2>

<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
    </div>
    <div class="mb-3">
        <label>Dirección</label>
        <textarea name="direccion" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
