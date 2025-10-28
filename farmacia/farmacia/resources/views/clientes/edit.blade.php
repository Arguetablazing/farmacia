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
        max-width: 700px;
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

    .form-control, textarea.form-control {
        border: 1.5px solid rgba(100, 180, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
        color: #000000;
    }

    .form-control:focus, textarea.form-control:focus {
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

    .alert-danger li {
        margin-bottom: 5px;
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
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
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
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
    body.dark-mode textarea.form-control {
        background-color: #2a2a2a;
        color: #ffffff;
        border-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .form-control:focus,
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

        .btn-submit, .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-4">
    <div class="header-form">
        <h1>
            <i class="bi bi-pencil-square"></i> Editar Cliente
        </h1>
        <a href="{{ route('clientes.index') }}" class="btn-back">
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
                <i class="bi bi-person-lines-fill me-2" style="color: #2563eb;"></i> Actualizar Datos del Cliente
            </div>

            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre" class="form-label">
                        <i class="bi bi-person-fill"></i> Nombre Completo
                    </label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" placeholder="Ingresa el nombre completo" required>
                </div>

                <div class="form-group">
                    <label for="correo" class="form-label">
                        <i class="bi bi-envelope-fill"></i> Correo Electrónico
                    </label>
                    <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $cliente->correo) }}" placeholder="ejemplo@cliente.com">
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">
                        <i class="bi bi-telephone-fill"></i> Teléfono de Contacto
                    </label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}" placeholder="Ingresa el número de teléfono">
                </div>

                <div class="form-group">
                    <label for="direccion" class="form-label">
                        <i class="bi bi-geo-alt-fill"></i> Dirección
                    </label>
                    <textarea name="direccion" id="direccion" rows="3" class="form-control" placeholder="Ingresa la dirección del cliente">{{ old('direccion', $cliente->direccion) }}</textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-save"></i> Actualizar Cliente
                    </button>
                    <a href="{{ route('clientes.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
