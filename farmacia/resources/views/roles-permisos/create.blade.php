@extends('layouts.app')

@section('content')
<h2>Asignar Permiso</h2>

<form action="{{ route('roles-permisos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="rol">Rol</label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="">Seleccione un rol</option>
            <option value="Funcionario">Funcionario</option>
            <option value="Empleado">Empleado</option>
            <option value="Cajero">Cajero</option>
            <option value="Administrador">Administrador</option>
            <option value="Supervisor">Supervisor</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="funcionalidad">Funcionalidad</label>
        <input type="text" name="funcionalidad" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('roles-permisos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
