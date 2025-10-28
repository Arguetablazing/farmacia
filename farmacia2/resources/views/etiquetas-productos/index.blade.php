@extends('layouts.app')

@section('content')
@php
    $rolUsuario = strtolower(trim(Auth::user()->rol ?? ''));
    $puedeGestionarEtiquetas = in_array($rolUsuario, ['administrador', 'cajero']);
@endphp
<div class="section-header">
    <div class="section-header-content">
        <div class="section-icon">
            <i class="bi bi-tags-fill"></i>
        </div>
        <div>
            <h2>Etiquetas de Productos</h2>
            <p>Gestiona y genera códigos de barras para mantener tu inventario organizado.</p>
        </div>
    </div>
    <div class="section-actions">
        @if($puedeGestionarEtiquetas)
        <a href="{{ route('etiquetas-productos.create') }}" class="btn btn-gradient-success btn-icon">
            <i class="bi bi-plus-circle"></i>
            <span>Nueva etiqueta</span>
        </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mt-4" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-check-circle-fill fs-4"></i>
            <div>
                <div class="fw-semibold">¡Éxito!</div>
                <small class="text-success-emphasis">{{ session('success') }}</small>
            </div>
        </div>
    </div>
@endif

<div class="card-surface compact mt-4">
    <div class="table-responsive">
        <table class="table table-elevated align-middle">
            <thead>
                <tr>
                    <th class="text-uppercase">ID</th>
                    <th class="text-uppercase">Producto</th>
                    <th class="text-uppercase">Código de Barras</th>
                    <th class="text-uppercase">Fecha Generada</th>
                    <th class="text-uppercase text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($etiquetas as $etiqueta)
                    <tr>
                        <td class="fw-bold text-primary">#{{ str_pad($etiqueta->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge-soft blue">
                                    <i class="bi bi-box-seam"></i>
                                    {{ $etiqueta->producto->nombre ?? 'Producto no asignado' }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="badge-soft blue">
                                <i class="bi bi-upc-scan"></i>
                                {{ $etiqueta->codigo_barras ?? 'Generando…' }}
                            </span>
                            @if($puedeGestionarEtiquetas && $etiqueta->codigo_barras)
                                <div class="mt-2">
                                    <a href="{{ route('etiquetas-productos.barcode', $etiqueta->id) }}" class="btn btn-gradient-success btn-icon btn-sm" target="_blank">
                                        <i class="bi bi-upc"></i>
                                        <span>Ver código de barras</span>
                                    </a>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge-soft blue">
                                <i class="bi bi-calendar-event"></i>
                                {{ $etiqueta->fecha_generada ? \Illuminate\Support\Carbon::parse($etiqueta->fecha_generada)->format('d/m/Y') : 'Sin fecha' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                @if($puedeGestionarEtiquetas)
                                <a href="{{ route('etiquetas-productos.edit', $etiqueta->id) }}" class="btn btn-gradient-primary btn-icon">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Editar</span>
                                </a>
                                <form action="{{ route('etiquetas-productos.destroy', $etiqueta->id) }}" method="POST" onsubmit="return confirm('¿Eliminar la etiqueta seleccionada?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gradient-danger btn-icon">
                                        <i class="bi bi-trash"></i>
                                        <span>Eliminar</span>
                                    </button>
                                </form>
                                @else
                                <span class="text-muted fw-semibold">Solo lectura</span>
                                @endif


                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="table-empty">
                                <i class="bi bi-upc-scan display-4 d-block mb-3"></i>
                                <p class="mb-1">No hay etiquetas generadas todavía</p>
                                <small class="text-muted">Crea tu primera etiqueta para comenzar a imprimir códigos</small>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($etiquetas, 'links'))
        <div class="mt-4">
            {{ $etiquetas->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
