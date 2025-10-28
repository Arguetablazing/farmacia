@extends('layouts.app')

@section('content')
<style>
    * {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .header-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding: 30px 40px;
        background: linear-gradient(135deg, #1a3a52 0%, #0d2842 100%);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(30, 90, 150, 0.25);
        border: 1px solid rgba(100, 180, 255, 0.2);
    }

    .header-form h1 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.8rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-form i {
        font-size: 2rem;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(-3px);
        color: #ffffff;
    }

    .form-container {
        max-width: 860px;
        margin: 0 auto;
    }

    .card-form {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(100, 180, 255, 0.15);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        padding: 40px;
        margin-bottom: 30px;
    }

    .form-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1a3a52;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(100, 180, 255, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #1a3a52;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .form-label i {
        color: #2563eb;
        font-size: 1rem;
    }

    .form-control,
    .form-select,
    textarea.form-control {
        border: 1.5px solid rgba(100, 180, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
        color: #000000;
    }

    .form-control:focus,
    .form-select:focus,
    textarea.form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
        background-color: #ffffff;
        color: #000000;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 1px solid rgba(220, 38, 38, 0.3);
        color: #7f1d1d;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 25px;
    }

    .alert-danger strong {
        font-weight: 700;
    }

    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    .form-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid rgba(100, 180, 255, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }

    .btn-cancel {
        background: rgba(100, 180, 255, 0.1);
        color: #2563eb;
        border: 1.5px solid rgba(37, 99, 235, 0.3);
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: rgba(100, 180, 255, 0.2);
        border-color: rgba(37, 99, 235, 0.5);
        color: #2563eb;
    }

    body.dark-mode .card-form {
        background: #1e1e1e;
        border-color: rgba(100, 180, 255, 0.15);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    body.dark-mode .form-label {
        color: #e5e7eb;
    }

    body.dark-mode .form-control,
    body.dark-mode .form-select,
    body.dark-mode textarea.form-control {
        background-color: #2a2a2a;
        color: #ffffff;
        border-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .form-control:focus,
    body.dark-mode .form-select:focus,
    body.dark-mode textarea.form-control:focus {
        background-color: #2a2a2a;
        color: #ffffff;
    }

    body.dark-mode .form-title {
        color: #e5e7eb;
        border-bottom-color: rgba(100, 180, 255, 0.2);
    }

    @media (max-width: 768px) {
        .header-form {
            flex-direction: column;
            text-align: center;
            gap: 15px;
            padding: 25px 20px;
        }

        .header-form h1 {
            font-size: 1.4rem;
        }

        .card-form {
            padding: 25px;
        }

        .form-buttons {
            flex-direction: column-reverse;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-4">
    <div class="header-form">
        <h1>
            <i class="bi bi-box-seam"></i> Registrar Producto
        </h1>
        <a href="{{ route('productos.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    @if ($errors->any())
    <div class="alert-danger">
        <strong><i class="bi bi-exclamation-circle-fill me-2"></i>Corrige los siguientes errores:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-container">
        <div class="card-form">
            <div class="form-title">
                <i class="bi bi-tags-fill" style="color: #2563eb;"></i> Información del Producto
            </div>

            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="form-label">
                                <i class="bi bi-box"></i> Nombre del Producto
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del producto" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria" class="form-label">
                                <i class="bi bi-collection"></i> Categoría
                            </label>
                            <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria') }}" placeholder="Ej. Analgésicos">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="proveedor" class="form-label">
                                <i class="bi bi-truck"></i> Proveedor
                            </label>
                            <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{ old('proveedor') }}" placeholder="Nombre del proveedor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unidad_medida" class="form-label">
                                <i class="bi bi-rulers"></i> Unidad de Medida
                            </label>
                            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" value="{{ old('unidad_medida') }}" placeholder="Ej. Caja, Frasco, Tableta">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="descripcion" class="form-label">
                                <i class="bi bi-file-earmark-text"></i> Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" placeholder="Describe detalles importantes del producto">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-title" style="margin-top: 10px;">
                    <i class="bi bi-cash-stack" style="color: #16a34a;"></i> Inventario y Precios
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="precio_compra" class="form-label">
                                <i class="bi bi-cart"></i> Precio de Compra
                            </label>
                            <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control" value="{{ old('precio_compra') }}" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="precio_venta" class="form-label">
                                <i class="bi bi-currency-dollar"></i> Precio de Venta
                            </label>
                            <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta') }}" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock" class="form-label">
                                <i class="bi bi-boxes"></i> Stock Disponible
                            </label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" placeholder="Cantidad en inventario">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="estado" class="form-label">
                                <i class="bi bi-toggle-on"></i> Estado
                            </label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-save"></i> Guardar Producto
                    </button>
                    <a href="{{ route('productos.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
