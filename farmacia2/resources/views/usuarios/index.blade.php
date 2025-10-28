@extends('layouts.app')

@section('content')
<style>
    * {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .container {
        max-width: 1400px;
    }

    body {
        background-color: #ffffff;
        color: #000;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        gap: 20px;
        background: linear-gradient(135deg, #1a3a52 0%, #0d2842 100%);
        padding: 40px 50px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(30, 90, 150, 0.25);
        border: 1px solid rgba(100, 180, 255, 0.2);
    }

    .header-section h2 {
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        flex: 1;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-section h2 i {
        font-size: 2.5rem;
    }

    .btn-create-primary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        font-weight: 700;
        border-radius: 10px;
        padding: 14px 32px;
        border: 1px solid rgba(16, 185, 129, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        font-size: 0.95rem;
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-create-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff;
    }

    .card-table {
        border-radius: 16px;
        border: 1px solid rgba(100, 180, 255, 0.15);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: #ffffff;
    }

    .table {
        margin-bottom: 0;
        color: #000;
    }

    .table thead th {
        background: linear-gradient(135deg, #1e40af 0%, #1a3a52 100%);
        border: none;
        font-weight: 800;
        color: #ffffff;
        padding: 18px 15px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.9rem;
        font-weight: 500;
        color: #000;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(37, 99, 235, 0.05);
        box-shadow: inset 0 0 10px rgba(59, 130, 246, 0.08);
    }

    .avatar-img {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid rgba(100, 180, 255, 0.4);
        box-shadow: 0 4px 12px rgba(30, 90, 150, 0.15);
    }

    .avatar-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        box-shadow: 0 4px 12px rgba(30, 90, 150, 0.15);
        border: 2px solid rgba(100, 180, 255, 0.4);
    }

    .user-name {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        color: #1a3a52;
    }

    .user-email {
        color: #6b7280;
        font-size: 0.85rem;
        margin-top: 3px;
    }

    .badge-rol {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-funcionario {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
        border: 1px solid rgba(100, 180, 255, 0.3);
    }

    .badge-empleado {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(6, 182, 212, 0.25);
        border: 1px solid rgba(6, 182, 212, 0.3);
    }

    .badge-cajero {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .badge-administrador {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-supervisor {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.25);
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .badge-estado {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-activo {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-inactivo {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #7f1d1d;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-action {
        background-color: #f3f4f6;
        border: 1px solid rgba(100, 180, 255, 0.2);
        color: #1a3a52;
        padding: 8px 14px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-action:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .btn-edit {
        color: #fff;
        border-color: rgba(37, 99, 235, 0.3);
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-edit:hover {
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #fff;
    }

    .btn-delete {
        color: #fff;
        border-color: rgba(239, 68, 68, 0.3);
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        color: #fff;
    }

    .alert-custom {
        border-radius: 12px;
        border: 1px solid rgba(16, 185, 129, 0.2);
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
        margin-bottom: 30px;
        font-weight: 500;
        padding: 16px 20px;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .alert-custom i {
        color: #10b981;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
        color: #d1d5db;
    }

    .empty-state p {
        font-size: 1.2rem;
        margin: 0;
        color: #4b5563;
        font-weight: 600;
    }

    .empty-state small {
        color: #9ca3af;
    }

    .stats-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(100, 180, 255, 0.15);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        font-size: 2rem;
        padding: 12px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
    }

    .stat-icon-blue {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        color: #2563eb;
    }

    .stat-content h3 {
        font-size: 0.9rem;
        color: #6b7280;
        margin: 0 0 5px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 1.8rem;
        color: #1a3a52;
        font-weight: 800;
        margin: 0;
    }

    /* DARK MODE */
    body.dark-mode {
        background-color: #0f0f0f;
        color: #e5e7eb;
    }

    body.dark-mode .header-section {
        background: linear-gradient(135deg, #1a3a52 0%, #0d2842 100%);
        box-shadow: 0 8px 24px rgba(30, 90, 150, 0.25);
        border: 1px solid rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .card-table {
        background-color: #f5f5f5;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(100, 180, 255, 0.15);
    }

    body.dark-mode .table {
        color: #000;
    }

    body.dark-mode .table thead th {
        background: linear-gradient(135deg, #1e40af 0%, #1a3a52 100%);
        color: #fff;
    }

    body.dark-mode .table tbody td {
        border-bottom-color: #2a2a2a;
        color: #000;
    }

    body.dark-mode .table tbody tr:hover {
        background-color: rgba(37, 99, 235, 0.1);
        box-shadow: inset 0 0 10px rgba(59, 130, 246, 0.1);
    }

    body.dark-mode .btn-action {
        background-color: #2a2a2a;
        border-color: rgba(100, 180, 255, 0.3);
        color: #e5e7eb;
    }

    body.dark-mode .btn-action:hover {
        background-color: #333333;
    }

    body.dark-mode .btn-edit {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-color: rgba(59, 130, 246, 0.5);
        color: #fff;
    }

    body.dark-mode .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border-color: rgba(239, 68, 68, 0.5);
        color: #fff;
    }

    body.dark-mode .empty-state {
        color: #9ca3af;
    }

    body.dark-mode .empty-state p {
        color: #d1d5db;
    }

    body.dark-mode .alert-custom {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
        border-color: rgba(16, 185, 129, 0.3);
        color: #a7f3d0;
    }

    body.dark-mode .user-name {
        color: #000;
    }

    body.dark-mode .stat-card {
        background: #f5f5f5;
        border-color: rgba(100, 180, 255, 0.15);
    }

    body.dark-mode .stat-value {
        color: #000;
    }

    body.dark-mode .stat-content h3 {
        color: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-section {
            flex-direction: column;
            text-align: center;
            padding: 25px 20px;
            margin-bottom: 25px;
        }

        .header-section h2 {
            font-size: 1.4rem;
        }

        .avatar-img,
        .avatar-placeholder {
            width: 65px;
            height: 65px;
            font-size: 1.2rem;
        }

        .btn-action {
            padding: 6px 10px;
            font-size: 0.7rem;
        }

        .actions-cell {
            flex-wrap: wrap;
        }

        .stats-section {
            grid-template-columns: 1fr;
        }

        .table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }

        .table thead th {
            padding: 12px 8px;
            font-size: 0.7rem;
        }

        .user-name {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

@php
    $rolUsuario = strtolower(trim(Auth::user()->rol ?? ''));
    $puedeGestionarUsuarios = in_array($rolUsuario, ['administrador', 'cajero']);
@endphp

<div class="container py-4">
    <!-- Header Premium -->
    <div class="header-section">
        <h2>
            <i class="bi bi-people-fill"></i> Panel de Usuarios
        </h2>
        @if($puedeGestionarUsuarios)
        <a href="{{ route('usuarios.create') }}" class="btn-create-primary">
            <i class="bi bi-person-plus-fill"></i> Nuevo Usuario
        </a>
        @endif
    </div>

    <!-- Alertas -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Estadísticas -->
    @if(count($usuarios) > 0)
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-content">
                <h3>Total de Usuarios</h3>
                <p class="stat-value">{{ count($usuarios) }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); color: #10b981;">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>Usuarios Activos</h3>
                <p class="stat-value">{{ count($usuarios->where('estado', true)) }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabla Premium -->
    <div class="card card-table">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="10%">ID</th>
                        <th scope="col" width="15%">Usuario</th>
                        <th scope="col" width="20%">Correo</th>
                        <th scope="col" width="15%">Rol</th>
                        <th scope="col" width="12%">Estado</th>
                        <th scope="col" class="text-center" width="18%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td class="fw-bold">#{{ $usuario->id }}</td>
                        <td>
                            <div class="user-name">
                                @if($usuario->imagen)
                                    <img src="{{ asset('storage/' . $usuario->imagen) }}" 
                                         alt="Imagen de {{ $usuario->nombre }}" 
                                         class="avatar-img">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div>{{ $usuario->nombre }}</div>
                                    <div class="user-email">{{ $usuario->correo }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <small>{{ $usuario->correo }}</small>
                        </td>
                        <td>
                            @php
                                $rol_class = 'badge-' . strtolower(str_replace(' ', '', $usuario->rol));
                            @endphp
                            <span class="badge-rol {{ $rol_class }}">
                                <i class="bi bi-shield-check me-1"></i>{{ $usuario->rol }}
                            </span>
                        </td>
                        <td>
                            @if($usuario->estado)
                                <span class="badge-estado badge-activo">
                                    <i class="bi bi-check-circle-fill"></i> Activo
                                </span>
                            @else
                                <span class="badge-estado badge-inactivo">
                                    <i class="bi bi-dash-circle-fill"></i> Inactivo
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                @if($puedeGestionarUsuarios)
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-edit" title="Editar Usuario">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a ' + '{{ $usuario->nombre }}' + '?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Eliminar Usuario">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                                @else
                                <span class="text-muted fw-semibold">Sin acciones disponibles</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>No hay usuarios registrados</p>
                                <small>Haz clic en "Nuevo Usuario" para comenzar a agregar usuarios</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
