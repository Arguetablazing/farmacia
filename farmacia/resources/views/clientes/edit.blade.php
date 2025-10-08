@extends('layouts.app')

@section('content')
<h2>Editar Cliente</h2>

<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" value="{{ $cliente->correo }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Dirección</label>
        <textarea name="direccion" class="form-control">{{ $cliente->direccion }}</textarea>
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
