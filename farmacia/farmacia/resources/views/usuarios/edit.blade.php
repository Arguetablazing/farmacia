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

    .form-control, .form-select {
        border: 1.5px solid rgba(100, 180, 255, 0.3);
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
        color: #000000;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
        background-color: #ffffff;
        color: #000000;
    }

    .input-group .form-control {
        border-right: none;
    }

    .input-group .btn-toggle-password {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        border: 1.5px solid #2563eb;
        color: #ffffff;
        border-radius: 0 10px 10px 0;
        padding: 0 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        position: relative;
        z-index: 5;
    }

    .input-group .btn-toggle-password:hover {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    
    .input-group .btn-toggle-password:focus,
    .input-group .btn-toggle-password:active {
        outline: none !important;
        box-shadow: none !important;
        border-color: #2563eb !important;
    }
    
    /* Prevenir comportamiento de confirmación */
    .input-group .btn-toggle-password::before {
        display: none !important;
    }

    .form-check {
        padding: 15px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(30, 64, 175, 0.05) 100%);
        border-radius: 10px;
        border: 1px solid rgba(100, 180, 255, 0.2);
    }

    .form-check-input {
        width: 20px;
        height: 20px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #2563eb;
        border: 2px solid rgba(100, 180, 255, 0.5);
        border-radius: 4px;
    }

    .form-check-input:checked {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .form-check-label {
        margin-left: 8px;
        cursor: pointer;
        font-weight: 500;
        color: #1a3a52;
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
        display: flex;
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

    .image-preview-container {
        display: flex;
        gap: 15px;
        align-items: flex-start;
        margin-top: 15px;
        padding: 15px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(30, 64, 175, 0.05) 100%);
        border-radius: 10px;
        border: 1px solid rgba(100, 180, 255, 0.2);
    }

    .image-current {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid rgba(100, 180, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .image-info {
        flex: 1;
    }

    .image-info-label {
        font-weight: 600;
        color: #1a3a52;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }

    .image-preview {
        width: 100%;
        max-width: 150px;
        height: auto;
        border-radius: 10px;
        margin-top: 12px;
        border: 2px solid rgba(100, 180, 255, 0.3);
    }

    .helper-text {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 5px;
    }

    /* DARK MODE */
    body.dark-mode .card-form {
        background: #1e1e1e;
        border-color: rgba(100, 180, 255, 0.15);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    body.dark-mode .form-label {
        color: #e5e7eb;
    }

    body.dark-mode .form-control, 
    body.dark-mode .form-select {
        background-color: #2a2a2a;
        color: #ffffff;
        border-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .form-control:focus, 
    body.dark-mode .form-select:focus {
        background-color: #2a2a2a;
        color: #ffffff;
    }

    body.dark-mode .form-check {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        border-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .form-check-label {
        color: #e5e7eb;
    }

    body.dark-mode .form-title {
        color: #e5e7eb;
        border-bottom-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .image-preview-container {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        border-color: rgba(100, 180, 255, 0.2);
    }

    body.dark-mode .image-info-label {
        color: #e5e7eb;
    }

    body.dark-mode .helper-text {
        color: #9ca3af;
    }

    /* Responsive */
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

        .image-preview-container {
            flex-direction: column;
        }
    }
</style>

<div class="container py-4">
    <!-- Header Premium -->
    <div class="header-form">
        <h1>
            <i class="bi bi-pencil-square"></i> Editar Usuario
        </h1>
        <a href="{{ route('usuarios.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Errores -->
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

    <!-- Formulario -->
    <div class="form-container">
        <div class="card-form">
            <div class="form-title">
                <i class="bi bi-pencil-square me-2" style="color: #2563eb;"></i> Información del Usuario
            </div>

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="form-group">
                    <label for="nombre" class="form-label">
                        <i class="bi bi-person-fill"></i> Nombre Completo
                    </label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}" placeholder="Ingresa el nombre completo" required>
                </div>

                <!-- Correo -->
                <div class="form-group">
                    <label for="correo" class="form-label">
                        <i class="bi bi-envelope-fill"></i> Correo Electrónico
                    </label>
                    <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}" placeholder="ejemplo@farmacia.com" required>
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="contraseña" class="form-label">
                        <i class="bi bi-lock-fill"></i> Contraseña
                    </label>
                    <div class="input-group">
                        <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="Dejar en blanco para no cambiar" autocomplete="new-password">
                        <button type="button" class="btn btn-toggle-password" data-field-id="contraseña" tabindex="-1">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    <div class="helper-text">
                        <i class="bi bi-info-circle me-1"></i>Dejar vacío para mantener la contraseña actual
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <label for="contraseña_confirmation" class="form-label">
                        <i class="bi bi-lock-fill"></i> Confirmar Contraseña
                    </label>
                    <div class="input-group">
                        <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" class="form-control" placeholder="Confirma tu contraseña" autocomplete="new-password">
                        <button type="button" class="btn btn-toggle-password" data-field-id="contraseña_confirmation" tabindex="-1">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>

                <!-- Rol -->
                <div class="form-group">
                    <label for="rol" class="form-label">
                        <i class="bi bi-shield-check"></i> Rol
                    </label>
                    <select name="rol" id="rol" class="form-select" required>
                        @foreach (['Empleado', 'Cajero', 'Administrador', 'Supervisor'] as $rol)
                            <option value="{{ $rol }}" {{ old('rol', $usuario->rol) === $rol ? 'selected' : '' }}>{{ $rol }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="estado" id="estado" class="form-check-input" {{ old('estado', $usuario->estado) ? 'checked' : '' }}>
                        <label for="estado" class="form-check-label">
                            <i class="bi bi-check2-circle me-1"></i> Activar usuario
                        </label>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="form-group">
                    <label for="imagen" class="form-label">
                        <i class="bi bi-image"></i> Foto de Perfil
                    </label>
                    <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" onchange="previewImage(event)">

                    @if($usuario->imagen)
                    <div class="image-preview-container">
                        <div>
                            <span class="image-info-label"><i class="bi bi-image me-2"></i>Foto Actual</span>
                            <img src="{{ asset('storage/' . $usuario->imagen) }}" alt="Imagen actual" class="image-current">
                        </div>
                        <div class="image-info">
                            <span class="image-info-label"><i class="bi bi-info-circle me-2"></i>Información</span>
                            <p class="helper-text">Esta es la foto de perfil actual del usuario. Puedes cambiarla seleccionando una nueva imagen arriba.</p>
                        </div>
                    </div>
                    @endif

                    <img id="preview" class="image-preview" style="display: none;">
                </div>

                <!-- Botones -->
                <div class="form-buttons">
                    <a href="{{ route('usuarios.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill"></i> Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(id, event) {
    // Obtener el evento si no se proporciona
    event = event || window.event;
    
    // Prevenir comportamiento predeterminado y detener propagación
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Obtener el campo de contraseña
    const input = document.getElementById(id);
    if (!input) return false;
    
    // Cambiar el tipo de campo
    if (input.type === "password") {
        input.type = "text";
        // Cambiar el ícono si existe
        const icon = document.querySelector(`button[onclick*="${id}"] i`);
        if (icon) {
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        }
    } else {
        input.type = "password";
        // Cambiar el ícono si existe
        const icon = document.querySelector(`button[onclick*="${id}"] i`);
        if (icon) {
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    }
    
    // Evitar que el formulario se envíe o cualquier otra acción
    return false;
}

function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// Asegurarse de que los botones de toggle funcionen correctamente
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de toggle
    const toggleButtons = document.querySelectorAll('.btn-toggle-password');
    
    // Agregar event listeners a cada botón
    toggleButtons.forEach(button => {
        // Obtener el ID del campo desde el atributo data-field-id
        const fieldId = button.getAttribute('data-field-id');
        if (fieldId) {
            // Agregar event listener
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Llamar a la función togglePassword directamente
                togglePassword(fieldId, e);
                
                return false;
            });
        }
    });
});
</script>
@endsection
