@extends('layouts.app')

@section('content')
<h2>Editar Permiso</h2>

<form action="{{ route('roles-permisos.update', $rolPermiso->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="rol">Rol</label>
        <select name="rol" class="form-control" required>

            <option value="Empleado" {{ $rolPermiso->rol == 'Empleado' ? 'selected' : '' }}>Empleado</option>
            <option value="Cajero" {{ $rolPermiso->rol == 'Cajero' ? 'selected' : '' }}>Cajero</option>
            <option value="Administrador" {{ $rolPermiso->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="Supervisor" {{ $rolPermiso->rol == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="funcionalidad">Funcionalidad</label>
        <input type="text" name="funcionalidad" class="form-control" value="{{ $rolPermiso->funcionalidad }}" required>
    </div>
    <div class="mb-3">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control">{{ $rolPermiso->descripcion }}</textarea>
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('roles-permisos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
