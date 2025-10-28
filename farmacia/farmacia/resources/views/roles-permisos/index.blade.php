@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Roles y Permisos</h2>
    <a href="{{ route('roles-permisos.create') }}" class="btn btn-success">Nuevo Permiso</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Funcionalidad</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rolesPermisos as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->rol }}</td>
            <td>{{ $item->funcionalidad }}</td>
            <td>{{ $item->descripcion }}</td>
            <td>
                <a href="{{ route('roles-permisos.edit', $item->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('roles-permisos.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este permiso?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
