@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Usuarios</h2>
    <a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo Usuario</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->correo }}</td>
            <td>{{ $usuario->rol }}</td>
            <td>{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</td>
            <td>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?')">
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
