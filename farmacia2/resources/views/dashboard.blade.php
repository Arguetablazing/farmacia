<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Farmacia</title>
    <link rel="icon" type="image/png" href="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        body {
            min-height:100vh;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #ecf0f5 50%, #e0f2fe 100%);
            background-attachment: fixed;
            display:flex;
            flex-direction:column;
            color:#1e293b;
        }

        /* ====== DARK MODE ====== */
        body.dark-mode {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #0d2842 100%);
            color: #e5e7eb;
        }

        /* ====== Navbar custom para dashboard ====== */
        nav.navbar {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 249, 255, 0.95) 100%) !important;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }

        body.dark-mode nav.navbar {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.98) 0%, rgba(20, 30, 50, 0.98) 100%) !important;
            border-bottom-color: rgba(100, 180, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }

        nav.navbar .navbar-brand {
            color: #1e293b !important;
            font-weight: 800;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        body.dark-mode nav.navbar .navbar-brand {
            color: #fff !important;
        }

        nav.navbar .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        nav.navbar .navbar-brand img {
            transition: all 0.3s ease;
            width: 32px;
            height: 32px;
            filter: brightness(1.2);
        }
        
        nav.navbar .navbar-brand img:hover {
            transform: scale(1.1);
        }

        /* ====== Botón "Volver al Dashboard" ====== */
        .back-dashboard {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1.5px solid rgba(37, 99, 235, 0.3);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .back-dashboard:hover {
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
        }

        /* ====== Tarjeta de bienvenida ====== */
        .welcome-card {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(15, 23, 42, 0.08) 100%);
            border-radius: 24px;
            padding: 32px;
            border: 1px solid rgba(37, 99, 235, 0.18);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .welcome-card .badge-role {
            font-size: 0.75rem;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            background: rgba(37, 99, 235, 0.12);
            color: #1e3a8a;
            border-radius: 999px;
            padding: 6px 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .welcome-card .badge-role i {
            font-size: 1rem;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            font-size: 1rem;
            color: #475569;
            margin: 0;
            font-weight: 500;
        }

        .welcome-avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(37, 99, 235, 0.3);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.2);
        }

        .avatar-nav {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(148, 163, 184, 0.4);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.3);
        }

        body.dark-mode .welcome-card {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.65) 0%, rgba(8, 47, 73, 0.65) 100%);
            border-color: rgba(100, 180, 255, 0.25);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.45);
        }

        body.dark-mode .welcome-title {
            color: #f8fafc;
        }

        body.dark-mode .welcome-subtitle {
            color: #cbd5f5;
        }

        body.dark-mode .welcome-card .badge-role {
            background: rgba(37, 99, 235, 0.25);
            color: #e0f2fe;
        }

        body.dark-mode .avatar-nav {
            border-color: rgba(100, 180, 255, 0.35);
        }


        .content { flex:1; padding:50px 5%; }
        .content-header {
            text-align:center;
            margin-bottom:50px;
            animation: slideDown 0.6s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .content h2 { 
            font-weight:800; 
            font-size:2.5rem; 
            color: #1e293b;
            margin-bottom:10px;
        }

        body.dark-mode .content h2 {
            color: #fff;
        }

        .content p { 
            color:#64748b; 
            margin-bottom:15px;
            font-size:1rem;
            font-weight:500;
        }

        body.dark-mode .content p {
            color: #a3a3a3;
        }
        .dashboard {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
            gap:30px;
            max-width:1400px;
            margin:0 auto;
        }

        .card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(240, 249, 255, 0.8) 100%);
            border: 1.5px solid rgba(37, 99, 235, 0.2);
            border-radius:16px;
            padding:40px 20px;
            height:220px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            text-align:center;
            backdrop-filter:blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            position:relative;
            overflow:hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor:pointer;
            animation: fadeInUp 0.6s ease backwards;
        }

        body.dark-mode .card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.9) 0%, rgba(20, 40, 60, 0.9) 100%);
            border-color: rgba(100, 180, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
        .card:nth-child(7) { animation-delay: 0.7s; }
        .card:nth-child(8) { animation-delay: 0.8s; }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card::before {
            content:"";
            position:absolute;
            top:0; left:0;
            width:100%; height:100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index:1;
        }
        .card:hover::before {
            opacity: 1;
        }
        .card:hover { 
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 16px 48px rgba(37, 99, 235, 0.4);
            border-color: rgba(37, 99, 235, 0.6);
        }
        .card i { 
            font-size:3.2rem; 
            margin-bottom:15px; 
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.4s ease;
            z-index: 2;
            position: relative;
        }
        .card:hover i { 
            transform: scale(1.25) rotateZ(10deg);
        }
        .card h5 { 
            color:#1e293b; 
            font-weight:700;
            z-index:2; 
            position:relative;
            font-size:1.05rem;
            letter-spacing:0.3px;
        }

        body.dark-mode .card h5 {
            color: #fff;
        }
        .card a { position:absolute; inset:0; z-index:3; }

        footer { 
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color:#1e293b; 
            text-align:center; 
            padding:16px;
            font-size:0.9rem; 
            letter-spacing:0.5px; 
            font-weight:600;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.05);
        }

        body.dark-mode footer {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.95) 0%, rgba(20, 30, 50, 0.95) 100%);
            color: #a3a3a3;
            border-top: 1px solid rgba(100, 180, 255, 0.2);
            box-shadow: 0 -4px 12px rgba(0,0,0,0.3);
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }
            nav .brand {
                font-size: 1.3rem;
            }
            .content {
                padding: 30px 20px;
            }
            .content h2 {
                font-size: 1.8rem;
            }
            .dashboard {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 20px;
            }
            .card {
                padding: 30px 15px;
                height: 180px;
            }
        }
    </style>
</head>
<body>

    <!-- ====== NAVBAR BOOTSTRAP ====== -->
    <nav class="navbar navbar-expand-lg shadow-sm px-3" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(30, 41, 59, 0.98) 100%);">
        <a class="navbar-brand" href="#">
            <img src="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg" alt="Farmacia">
            Sistema de Farmacia
        </a>

        @php
            $usuarioAutenticado = Auth::user();
            $rolActual = strtoupper($usuarioAutenticado->rol ?? 'Usuario');
            $nombreUsuario = $usuarioAutenticado->nombre ?? 'Usuario';
            $avatarUsuario = $usuarioAutenticado->imagen ? asset('storage/' . $usuarioAutenticado->imagen) : 'https://ui-avatars.com/api/?name=' . urlencode($nombreUsuario) . '&background=3b82f6&color=fff&size=128';
        @endphp

        <div class="ms-auto d-flex align-items-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $avatarUsuario }}" alt="Avatar de {{ $nombreUsuario }}" class="avatar-nav">
                <div class="text-end">
                    <span class="badge-role"><i class="bi bi-shield-check"></i> {{ $rolActual }}</span>
                    <div class="fw-semibold" style="color: #1e293b;">{{ $nombreUsuario }}</div>
                </div>
            </div>

            <!-- Botón de cerrar sesión -->
            <a href="{{ route('logout') }}" class="back-dashboard" style="margin-left: 10px; background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); border-color: rgba(220, 38, 38, 0.3);">
                <i class="bi bi-box-arrow-right"></i> Cerrar
            </a>
        </div>
    </nav>

    <div class="content">
        <div class="welcome-card mb-4">
            <div>
                <span class="badge-role"><i class="bi bi-stars"></i> BIENVENIDO</span>
                <h1 class="welcome-title">Hola, {{ $rolActual }} {{ $nombreUsuario }}</h1>
                <p class="welcome-subtitle">Accede a las herramientas disponibles para tu rol y gestiona la información de forma eficiente.</p>
            </div>
            <img src="{{ $avatarUsuario }}" alt="Avatar de {{ $nombreUsuario }}" class="welcome-avatar">
        </div>

        <div class="content-header">
            <h2>Panel de Control</h2>
            <p>Selecciona una sección según los permisos de tu rol.</p>
        </div>

        <div class="dashboard">

            {{-- Usuarios (Administrador y Supervisor) --}}
            @if(in_array(Auth::user()->rol, ['Administrador','Supervisor']))
                <div class="card">
                    <i class="bi bi-people-fill"></i>
                    <h5>Usuarios</h5>
                    @if(Auth::user()->rol === 'Supervisor')
                        <small style="color: rgba(15,23,42,0.65); font-weight:600;">Solo lectura</small>
                    @endif
                    <a href="{{ route('usuarios.index') }}"></a>
                </div>
            @endif

            {{-- Solo Administrador --}}
            @if(Auth::user()->rol == 'Administrador')
                <div class="card"><i class="bi bi-journal-text"></i><h5>Bitácora</h5><a href="{{ route('bitacora-operaciones.index') }}"></a></div>
            @endif

            {{-- Administrador, Cajero, Empleado, Supervisor --}}
            @if(in_array(Auth::user()->rol, ['Administrador','Cajero','Empleado','Supervisor']))
                <div class="card"><i class="bi bi-person-lines-fill"></i><h5>Clientes</h5><a href="{{ route('clientes.index') }}"></a></div>
                <div class="card"><i class="bi bi-capsule"></i><h5>Productos</h5><a href="{{ route('productos.index') }}"></a></div>
            @endif

            {{-- Administrador, Cajero, Supervisor --}}
            @if(in_array(Auth::user()->rol, ['Administrador','Cajero','Supervisor']))
                <div class="card"><i class="bi bi-receipt"></i><h5>Facturas</h5><a href="{{ route('facturas.index') }}"></a></div>
                <div class="card"><i class="bi bi-tags-fill"></i><h5>Etiquetas Productos</h5><a href="{{ route('etiquetas-productos.index') }}"></a></div>
            @endif

        </div>
    </div>

    <footer>
        © {{ date('Y') }} Farmacia - Sistema de Gestión | AC
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
