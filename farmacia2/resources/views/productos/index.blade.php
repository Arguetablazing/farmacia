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

    .btn-primary-action {
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

    .btn-primary-action:hover {
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

    .product-info {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        color: #1a3a52;
    }

    .product-badge {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 12px rgba(30, 90, 150, 0.15);
        border: 2px solid rgba(100, 180, 255, 0.4);
    }

    .product-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .product-meta small {
        color: #6b7280;
        font-weight: 500;
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-active {
        background: rgba(16, 185, 129, 0.12);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-inactive {
        background: rgba(239, 68, 68, 0.12);
        color: #b91c1c;
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

    .btn-edit {
        color: #fff;
        border-color: rgba(37, 99, 235, 0.3);
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-delete {
        color: #fff;
        border-color: rgba(239, 68, 68, 0.3);
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
    }

    .btn-action:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .btn-edit:hover {
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #fff;
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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

    @media (max-width: 992px) {
        .header-section {
            flex-direction: column;
            text-align: center;
            padding: 30px;
        }

        .header-section h2 {
            font-size: 1.6rem;
        }

        .btn-primary-action {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
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

        .product-info {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="container py-4">
    @php
        $productosBase = $productos instanceof \Illuminate\Pagination\AbstractPaginator ? $productos->getCollection() : $productos;
        $totalProductos = $productosBase->count();
        $stockTotal = $productosBase->sum(function ($producto) {
            return (int) ($producto->stock ?? 0);
        });
        $productosActivos = $productosBase->where('estado', true)->count();
    @endphp

    <div class="header-section">
        <h2>
            <i class="bi bi-box-seam"></i> Panel de Inventario
        </h2>
        @if(in_array(Auth::user()->rol, ['Administrador', 'Cajero']))
            <a href="{{ route('productos.create') }}" class="btn-primary-action">
                <i class="bi bi-plus-circle"></i> Nuevo Producto
            </a>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($totalProductos > 0)
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-box"></i>
            </div>
            <div class="stat-content">
                <h3>Total de Productos</h3>
                <p class="stat-value">{{ $totalProductos }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); color: #10b981;">
                <i class="bi bi-layers"></i>
            </div>
            <div class="stat-content">
                <h3>Stock Disponible</h3>
                <p class="stat-value">{{ $stockTotal }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.1) 100%); color: #2563eb;">
                <i class="bi bi-lightning-charge"></i>
            </div>
            <div class="stat-content">
                <h3>Activos</h3>
                <p class="stat-value">{{ $productosActivos }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%); color: #dc2626;">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h3>Inactivos</h3>
                <p class="stat-value">{{ $totalProductos - $productosActivos }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="card-table">
        @if($totalProductos > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>
                            <div class="product-info">
                                <div class="product-badge">
                                    {{ strtoupper(substr($producto->nombre, 0, 2)) }}
                                </div>
                                <div class="product-meta">
                                    <span>{{ $producto->nombre }}</span>
                                    <small>{{ $producto->descripcion ?: 'Sin descripción' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $producto->categoria ?: 'Sin categoría' }}</td>
                        <td>{{ $producto->proveedor ?: 'Sin proveedor' }}</td>
                        <td>${{ number_format($producto->precio_compra ?? 0, 2) }}</td>
                        <td>${{ number_format($producto->precio_venta ?? 0, 2) }}</td>
                        <td>{{ $producto->stock ?? 0 }}</td>
                        <td>
                            <span class="badge-status {{ $producto->estado ? 'badge-active' : 'badge-inactive' }}">
                                <i class="bi {{ $producto->estado ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="actions-cell">
                            @if(in_array(Auth::user()->rol, ['Administrador', 'Cajero']))
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            @elseif(strtolower(Auth::user()->rol) === 'supervisor')
                                <span class="badge bg-info text-dark">Vista únicamente</span>
                            @else
                                <span class="badge bg-secondary">Sin permisos</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-box-seam"></i>
            <p>No hay productos registrados.</p>
            <small>Comienza agregando nuevos productos para gestionar tu inventario.</small>
        </div>
        @endif
    </div>
</div>
@endsection
