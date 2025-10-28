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
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: #ffffff;
        font-weight: 700;
        border-radius: 10px;
        padding: 14px 32px;
        border: 1px solid rgba(37, 99, 235, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        font-size: 0.95rem;
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
    }

    .btn-secondary-action {
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary-action:hover {
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

    .card-table .table-responsive {
        overflow-x: auto;
    }

    .card-table .table {
        min-width: 1150px;
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

    .factura-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .factura-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 0.85rem;
        color: #4b5563;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(30, 64, 175, 0.08) 100%);
        border: 1px solid rgba(100, 180, 255, 0.2);
        color: #1a3a52;
        font-weight: 600;
    }

    .detalle-wrapper {
        display: flex;
        flex-direction: column;
        gap: 6px;
        max-width: 200px;
        margin: 0 auto;
    }

    .detalle-item {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(30, 64, 165, 0.08) 100%);
        border: 1px solid rgba(100, 180, 255, 0.2);
        border-radius: 10px;
        padding: 6px 8px;
        box-shadow: inset 0 0 6px rgba(37, 99, 235, 0.08);
    }

    .detalle-producto {
        font-weight: 700;
        font-size: 0.8rem;
        color: #1a3a52;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .detalle-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .detalle-pill {
        background: #fff;
        border: 1px solid rgba(37, 99, 235, 0.2);
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #1a3a52;
        line-height: 1.2;
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

    .btn-report {
        color: #1a3a52;
        border-color: rgba(59, 130, 246, 0.3);
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(30, 64, 175, 0.15) 100%);
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-report:hover {
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.25) 0%, rgba(29, 78, 216, 0.25) 100%);
        color: #0f172a;
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

        .btn-primary-action,
        .btn-secondary-action {
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
    }
</style>

<div class="container py-4">
    @php
        $facturasBase = $facturas instanceof \Illuminate\Pagination\AbstractPaginator ? $facturas->getCollection() : $facturas;
        $totalFacturas = $facturasBase->count();
        $totalMonto = $facturasBase->sum('total');
        $enviadasCorreo = $facturasBase->where('enviada_por_correo', true)->count();
        $rolUsuario = strtolower(trim(Auth::user()->rol ?? ''));
        $puedeGestionarFactura = $rolUsuario && in_array($rolUsuario, ['administrador', 'cajero']);
        $puedeDescargarFactura = $rolUsuario && in_array($rolUsuario, ['administrador', 'cajero', 'supervisor']);
    @endphp

    <div class="header-section">
        <h2>
            <i class="bi bi-receipt"></i> Panel de Facturación
        </h2>
        <div class="d-flex flex-wrap gap-2">
            @if($puedeGestionarFactura)
                <a href="{{ route('facturas.create') }}" class="btn-secondary-action">
                    <i class="bi bi-plus-circle"></i> Nueva Factura
                </a>
            @endif
            @if (Route::has('facturas.report'))
            <a href="{{ route('facturas.report') }}" class="btn-primary-action" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Generar Reporte PDF
            </a>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($totalFacturas > 0)
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-content">
                <h3>Total de Facturas</h3>
                <p class="stat-value">{{ $facturas instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $facturas->total() : $totalFacturas }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); color: #10b981;">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-content">
                <h3>Ingresos Totales</h3>
                <p class="stat-value">${{ number_format($totalMonto, 2) }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.1) 100%); color: #2563eb;">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <div class="stat-content">
                <h3>Enviadas por correo</h3>
                <p class="stat-value">{{ $enviadasCorreo }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="card card-table">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="8%">ID</th>
                        <th scope="col" width="20%">Cliente</th>
                        <th scope="col" width="18%">Usuario</th>
                        <th scope="col" width="14%">Fecha</th>
                        <th scope="col" width="14%">Total</th>
                        <th scope="col" width="12%">Correo</th>
                        <th scope="col" width="14%">Detalles</th>
                        <th scope="col" class="text-center" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facturas as $factura)
                    <tr>
                        <td class="fw-bold">#{{ $factura->id }}</td>
                        <td>
                            <div class="factura-info">
                                <strong>{{ $factura->cliente->nombre }}</strong>
                                <div class="factura-meta">
                                    <span class="chip">
                                        <i class="bi bi-telephone-fill"></i> {{ $factura->cliente->telefono ?? 'Sin teléfono' }}
                                    </span>
                                    <span class="chip">
                                        <i class="bi bi-envelope-fill"></i> {{ $factura->cliente->correo ?? 'Sin correo' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="factura-info">
                                <strong>{{ $factura->usuario->nombre }}</strong>
                                <div class="factura-meta">
                                    <span class="chip">
                                        <i class="bi bi-at"></i> {{ $factura->usuario->correo ?? 'Sin correo' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="factura-info">
                                <strong>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</strong>
                                <div class="factura-meta">
                                    <span class="chip">
                                        <i class="bi bi-clock-history"></i> {{ \Carbon\Carbon::parse($factura->created_at)->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="factura-info">
                                <strong>${{ number_format($factura->total, 2) }}</strong>
                                <div class="factura-meta">
                                    <span class="chip">
                                        <i class="bi bi-currency-dollar"></i> Subtotal {{ number_format($factura->detalles->sum('subtotal'), 2) }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip">
                                <i class="bi bi-{{ $factura->enviada_por_correo ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                                {{ $factura->enviada_por_correo ? 'Enviada' : 'No enviada' }}
                            </span>
                        </td>
                        <td class="p-0">
                            <div class="detalle-wrapper">
                                @foreach($factura->detalles as $detalle)
                                    <div class="detalle-item">
                                        <div class="detalle-producto">{{ $detalle->producto->nombre }}</div>
                                        <div class="detalle-meta">
                                            <span class="detalle-pill">Cant: {{ $detalle->cantidad }}</span>
                                            <span class="detalle-pill">P. ${{ number_format($detalle->precio_unitario, 2) }}</span>
                                            <span class="detalle-pill">Subtotal ${{ number_format($detalle->subtotal, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            @if($puedeGestionarFactura)
                                <div class="actions-cell">
                                    <a href="{{ route('facturas.edit', $factura->id) }}" class="btn-action btn-edit">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar la factura #{{ $factura->id }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                    @if($puedeDescargarFactura)
                                        <a href="{{ route('facturas.download', $factura->id) }}" class="btn-action btn-report" target="_blank">
                                            <i class="bi bi-file-earmark-arrow-down"></i> PDF
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="actions-cell">
                                    @if($puedeDescargarFactura)
                                        <a href="{{ route('facturas.download', $factura->id) }}" class="btn-action btn-report" target="_blank">
                                            <i class="bi bi-file-earmark-arrow-down"></i> PDF
                                        </a>
                                    @else
                                        <div class="text-muted small fst-italic text-center">Sin permisos</div>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>No hay facturas registradas</p>
                                <small>Haz clic en "Nueva Factura" para comenzar a registrar facturas</small>
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
