@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Editar Usuario</h2>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Corrige los siguientes errores:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="border p-4 rounded shadow-sm bg-light">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}" required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}" required>
    </div>

    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña (dejar en blanco para no modificar)</label>
        <input type="password" name="contraseña" id="contraseña" class="form-control" autocomplete="new-password">
    </div>

    <div class="mb-3">
        <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" class="form-control" autocomplete="new-password">
    </div>

    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" id="rol" class="form-select" required>
            @foreach (['Funcionario', 'Empleado', 'Cajero', 'Administrador', 'Supervisor'] as $rol)
                <option value="{{ $rol }}" {{ old('rol', $usuario->rol) === $rol ? 'selected' : '' }}>{{ $rol }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="estado" id="estado" class="form-check-input" {{ old('estado', $usuario->estado) ? 'checked' : '' }}>
        <label for="estado" class="form-check-label">Activo</label>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
@endsection
