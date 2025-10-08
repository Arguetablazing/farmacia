@extends('layouts.app')

@section('content')
<h2>Crear Usuario</h2>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="correo">Correo</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="contraseña">Contraseña</label>
        <input type="password" name="contraseña" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="contraseña_confirmation">Confirmar Contraseña</label>
        <input type="password" name="contraseña_confirmation" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="rol">Rol</label>
        <select name="rol" class="form-control" required>
            <option value="Funcionario">Funcionario</option>
            <option value="Empleado">Empleado</option>
            <option value="Cajero">Cajero</option>
            <option value="Administrador">Administrador</option>
            <option value="Supervisor">Supervisor</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="estado">Estado</label>
        <input type="checkbox" name="estado" value="1" checked> Activo
    </div>
    <button class="btn btn-success">Crear</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
