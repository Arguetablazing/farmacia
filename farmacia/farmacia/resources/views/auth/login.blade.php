<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Farmacia</title>
    <link rel="icon" type="image/png" href="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #ecf0f5 50%, #e0f2fe 100%);
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 850px;
            min-height: 450px;
            display: flex;
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(240, 249, 255, 0.85) 100%);
            border: 1.5px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
            animation: slideUp 0.6s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Lado Izquierdo - Imagen */
        .login-image {
            display: none;
            width: 50%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(30, 64, 175, 0.1) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .login-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }
        
        .login-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(30, 64, 175, 0.15) 100%);
        }
        
        /* Lado Derecho - Formulario */
        .login-form {
            width: 100%;
            padding: 45px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        @media (min-width: 768px) {
            .login-image {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-form {
                width: 50%;
            }
        }
        
        /* Logo Bar */
        .logo-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1.5px solid rgba(37, 99, 235, 0.2);
        }
        
        .logo-bar img {
            height: 36px;
            object-fit: contain;
            transition: all 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }
        
        .logo-bar img:hover {
            transform: scale(1.1);
        }
        
        /* Títulos */
        h1 {
            color: #1e293b;
            font-weight: 800;
            font-size: 1.6rem;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .subtitle {
            color: #64748b;
            text-align: center;
            margin-bottom: 25px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* Error Box */
        .error-box {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(153, 27, 27, 0.05) 100%);
            border: 1.5px solid rgba(220, 38, 38, 0.3);
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .error-box i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        /* Form Groups */
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-label {
            color: #1e293b;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 7px;
            display: block;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: 1.5px solid rgba(37, 99, 235, 0.2);
            color: #1e293b;
            padding: 11px 15px;
            border-radius: 8px;
            font-size: 0.92rem;
            transition: all 0.3s ease;
        }
        
        .form-control::placeholder {
            color: #94a3b8;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(37, 99, 235, 0.5);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            color: #1e293b;
        }
        
        /* Password Toggle */
        .password-toggle {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 38px;
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 4px 8px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .toggle-password:hover {
            color: #2563eb;
            transform: scale(1.1);
        }
        
        /* Botón Enviar */
        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: #ffffff;
            border: none;
            padding: 11px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.97rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            margin-top: 9px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Links */
        .forgot-password {
            text-align: right;
            margin-top: 12px;
        }
        
        .forgot-password a {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #1e40af;
            text-decoration: underline;
        }
        
        /* Footer */
        footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1.5px solid rgba(37, 99, 235, 0.2);
            color: #64748b;
            font-size: 0.8rem;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                min-height: auto;
            }
            
            .login-form {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 1.4rem;
            }
            
            .logo-bar {
                gap: 14px;
                margin-bottom: 18px;
            }
            
            .logo-bar img {
                height: 32px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    
    <!-- Lado Izquierdo - Imagen -->
    <div class="login-image">
        <img src="https://st2.depositphotos.com/1003098/8163/i/450/depositphotos_81637954-stock-photo-pharmacy-interior.jpg" 
             alt="Farmacia Interior">
    </div>
    
    <!-- Lado Derecho - Formulario -->
    <div class="login-form">
        
        <!-- Logo Bar -->
        <div class="logo-bar">
            <img src="https://www.itca.edu.sv/wp-content/uploads/2025/01/LogoITCA_Web.png" 
                 alt="Logo ITCA FEPADE">
            <img src="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg" 
                 alt="Logo Farmacia">
        </div>
        
        <!-- Contenido -->
        <h1>Iniciar Sesión</h1>
        <p class="subtitle">Accede al sistema de gestión de farmacia</p>
        
        <!-- Mensajes de Error -->
        @if ($errors->any())
            <div class="error-box">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif
        
        <!-- Formulario -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <!-- Email -->
            <div class="form-group">
                <label class="form-label">
                    <i class="bi bi-envelope-fill" style="color: #2563eb; margin-right: 6px;"></i>
                    Correo electrónico
                </label>
                <input type="email" name="correo" class="form-control" 
                       placeholder="tu@correo.com" required value="{{ old('correo') }}">
            </div>
            
            <!-- Password -->
            <div class="form-group password-toggle">
                <label class="form-label">
                    <i class="bi bi-lock-fill" style="color: #2563eb; margin-right: 6px;"></i>
                    Contraseña
                </label>
                <input type="password" id="password" name="contraseña" class="form-control" 
                       placeholder="••••••••" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye-fill" id="toggleIcon"></i>
                </button>
            </div>
            
            <!-- Botón Enviar -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right" style="margin-right: 8px;"></i>
                Ingresar
            </button>
            
            <!-- Olvide Contraseña (Opcional) -->
            <div class="forgot-password">
                <a href="#"></a>
            </div>
        </form>
        
        <!-- Footer -->
        <footer>
            © {{ date('Y') }} Farmacia - Sistema de Gestión | AC
        </footer>
        
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye-fill');
            toggleIcon.classList.add('bi-eye-slash-fill');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash-fill');
            toggleIcon.classList.add('bi-eye-fill');
        }
    }
</script>

</body>
</html>