<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Farmacia</title>
    
    <!-- Favicon -->
    <link rel="icon" href="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg" type="image/svg+xml">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --color-primary: #2563eb;
            --color-primary-dark: #1e3a8a;
            --color-success: #059669;
            --color-danger: #dc2626;
            --color-surface: #ffffff;
            --color-surface-alt: #f8fbff;
            --color-border: rgba(37, 99, 235, 0.15);
            --shadow-soft: 0 18px 45px rgba(15, 23, 42, 0.12);
            --shadow-hover: 0 24px 60px rgba(37, 99, 235, 0.28);
        }

        * {
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f4f7fb 0%, #eef2ff 50%, #e0f2ff 100%);
            color: #0f172a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #05080f 0%, #0f172a 50%, #020617 100%);
            color: #e2e8f0;
        }

        /* ====== Navbar ====== */
        nav.navbar {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(226, 232, 255, 0.95) 100%) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(37, 99, 235, 0.12);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        body.dark-mode nav.navbar {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(8, 12, 29, 0.95) 100%) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        }

        nav .navbar-brand {
            color: #0f172a !important;
            font-weight: 800;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        nav .navbar-brand:hover {
            transform: scale(1.05);
        }

        nav .navbar-brand img {
            width: 34px;
            height: 34px;
            filter: brightness(1.1);
            transition: transform 0.3s ease;
        }

        nav .navbar-brand img:hover {
            transform: rotate(-6deg) scale(1.05);
        }

        body.dark-mode nav .navbar-brand {
            color: #e2e8f0 !important;
        }

        body.dark-mode nav .navbar-brand img {
            filter: brightness(1.3);
        }

        /* ====== Botón modo oscuro ====== */
        #darkModeToggle {
            background: linear-gradient(135deg, #0f172a 0%, #1f2937 100%);
            color: #fbbf24;
            border: 1px solid rgba(148, 163, 184, 0.25);
            padding: 10px 20px;
            border-radius: 26px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--shadow-soft);
            cursor: pointer;
            white-space: nowrap;
        }

        #darkModeToggle:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        body.dark-mode #darkModeToggle {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #0f172a;
            border-color: rgba(251, 191, 36, 0.5);
            box-shadow: 0 18px 35px rgba(251, 191, 36, 0.35);
        }

        .avatar-nav {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(148, 163, 184, 0.35);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.18);
        }

        body.dark-mode .avatar-nav {
            border-color: rgba(96, 165, 250, 0.4);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1e3a8a;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .badge-role i {
            font-size: 1rem;
        }

        body.dark-mode .badge-role {
            background: rgba(37, 99, 235, 0.25);
            color: #e0f2fe;
        }

        /* ====== Enlace al dashboard ====== */
        .back-dashboard {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 28px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid rgba(37, 99, 235, 0.3);
            box-shadow: var(--shadow-soft);
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .back-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            background: linear-gradient(135deg, #3b82f6 0%, var(--color-primary) 100%);
            color: #ffffff;
            text-decoration: none;
        }

        body.dark-mode .back-dashboard {
            border-color: rgba(59, 130, 246, 0.35);
        }

        /* ====== Contenedor principal ====== */
        .app-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.75rem;
        }

        /* ====== Encabezados de sección ====== */
        .section-header {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);
            border-radius: 20px;
            padding: 32px 36px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.25);
            color: #f8fafc;
        }

        .section-header.light {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(59, 130, 246, 0.95) 100%);
        }

        .section-header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .section-icon {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(148, 163, 184, 0.12) 0%, rgba(59, 130, 246, 0.25) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #f8fafc;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .section-header h2 {
            font-size: 2.1rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .section-header p {
            margin: 6px 0 0 0;
            font-size: 0.95rem;
            color: rgba(241, 245, 249, 0.9);
        }

        .section-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 12px;
        }

        /* ====== Tarjetas y tablas ====== */
        .card-surface {
            background: var(--color-surface);
            border-radius: 20px;
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-soft);
            padding: 28px 32px;
        }

        body.dark-mode .card-surface {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(148, 163, 184, 0.3);
            box-shadow: 0 24px 60px rgba(15, 15, 30, 0.65);
        }

        .card-surface.compact {
            padding: 22px 24px;
        }

        .table-responsive {
            border-radius: 16px;
            overflow: hidden;
        }

        .table-elevated {
            margin-bottom: 0;
        }

        .table-elevated thead th {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            border: none;
            color: #eff6ff;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding: 16px 18px;
        }

        .table-elevated tbody td {
            padding: 18px;
            vertical-align: middle;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            font-weight: 500;
        }

        .table-elevated tbody tr:last-child td {
            border-bottom: none;
        }

        .table-elevated tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }

        body.dark-mode .table-elevated thead th {
            color: #dbeafe;
        }

        body.dark-mode .table-elevated tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.12);
        }

        .table-empty {
            text-align: center;
            padding: 48px 16px;
            color: #64748b;
            font-weight: 600;
            font-size: 0.95rem;
        }

        body.dark-mode .table-empty {
            color: rgba(226, 232, 240, 0.7);
        }

        /* ====== Métricas ====== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
            margin-top: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(241, 245, 255, 0.95) 100%);
            border-radius: 18px;
            border: 1px solid rgba(37, 99, 235, 0.18);
            padding: 24px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .stat-card.dark {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(59, 130, 246, 0.95) 100%);
            color: #f8fafc;
            border-color: rgba(59, 130, 246, 0.35);
        }

        .stat-card-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: rgba(37, 99, 235, 0.12);
            color: var(--color-primary);
        }

        .stat-card-icon.success {
            background: rgba(16, 185, 129, 0.12);
            color: var(--color-success);
        }

        .stat-card-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(15, 23, 42, 0.65);
            margin-bottom: 4px;
        }

        .stat-card-value {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        body.dark-mode .stat-card {
            background: rgba(15, 23, 42, 0.75);
            border-color: rgba(148, 163, 184, 0.28);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.45);
        }

        body.dark-mode .stat-card-title {
            color: rgba(226, 232, 240, 0.7);
        }

        body.dark-mode .stat-card-value {
            color: #e2e8f0;
        }

        /* ====== Botones personalizados ====== */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: #fff;
            border: none;
            font-weight: 700;
            padding: 12px 26px;
            border-radius: 14px;
            box-shadow: var(--shadow-soft);
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #10b981 0%, var(--color-success) 100%);
            color: #fff;
            border: none;
            font-weight: 700;
            padding: 12px 26px;
            border-radius: 14px;
            box-shadow: var(--shadow-soft);
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #f87171 0%, var(--color-danger) 100%);
            color: #fff;
            border: none;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 12px;
        }

        .btn-neutral {
            background-color: rgba(15, 23, 42, 0.05);
            color: #1f2937;
            border: 1px solid rgba(148, 163, 184, 0.2);
            font-weight: 600;
            padding: 12px 22px;
            border-radius: 14px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-gradient-primary:hover,
        .btn-gradient-success:hover,
        .btn-neutral:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            color: #fff;
        }

        .btn-gradient-danger:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        body.dark-mode .btn-neutral {
            background-color: rgba(226, 232, 240, 0.08);
            color: #e2e8f0;
            border-color: rgba(148, 163, 184, 0.35);
        }

        /* ====== Formularios ====== */
        .form-card {
            padding: 36px 40px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            border-color: rgba(148, 163, 184, 0.25);
            padding: 12px 14px;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(37, 99, 235, 0.6);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: rgba(15, 23, 42, 0.6);
            color: #e2e8f0;
            border-color: rgba(148, 163, 184, 0.4);
        }

        .form-text {
            color: rgba(15, 23, 42, 0.6);
        }

        body.dark-mode .form-text {
            color: rgba(226, 232, 240, 0.65);
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .badge-soft.blue {
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            border: 1px solid rgba(37, 99, 235, 0.25);
        }

        body.dark-mode .badge-soft.blue {
            background: rgba(59, 130, 246, 0.18);
            color: #bfdbfe;
            border-color: rgba(59, 130, 246, 0.3);
        }

        /* ====== Responsivo ====== */
        @media (max-width: 992px) {
            .section-header {
                padding: 26px;
                text-align: center;
                justify-content: center;
            }

            .section-header-content {
                flex-direction: column;
            }

            .section-actions {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .app-container {
                padding: 0 1.25rem;
            }

            .card-surface {
                padding: 22px 20px;
            }

            .form-card {
                padding: 28px 24px;
            }
        }
    </style>
</head>

<body>
    <!-- ====== NAVBAR ====== -->
    @php
        $usuarioAutenticado = Auth::user();
        $rolActual = strtoupper($usuarioAutenticado->rol ?? 'USUARIO');
        $nombreUsuario = $usuarioAutenticado->name ?? ($usuarioAutenticado->nombre ?? 'Usuario');
        $avatarUsuario = $usuarioAutenticado && !empty($usuarioAutenticado->imagen)
            ? asset('storage/' . $usuarioAutenticado->imagen)
            : 'https://ui-avatars.com/api/?name=' . urlencode($nombreUsuario) . '&background=3b82f6&color=fff&size=128';
    @endphp

    <nav class="navbar navbar-expand-lg bg-light shadow-sm px-3">
        <a class="navbar-brand" href="#">
            <img src="https://images.vexels.com/media/users/3/136559/isolated/svg/624dd0a951a1e8a118215b1b24a0da59.svg" alt="Farmacia">
            Sistema de Farmacia
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
            @auth
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $avatarUsuario }}" alt="Avatar de {{ $nombreUsuario }}" class="avatar-nav">
                    <div class="text-end">
                        <span class="badge-role"><i class="bi bi-shield-check"></i> {{ $rolActual }}</span>
                        <div class="fw-semibold" style="color: #1e293b;">{{ $nombreUsuario }}</div>
                    </div>
                </div>
            @endauth

            <a href="{{ url('/dashboard') }}" class="back-dashboard">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>

            <button id="darkModeToggle">
                <i class="bi bi-moon-fill"></i>
                <span>Oscuro</span>
            </button>
        </div>
    </nav>

    <!-- ====== CONTENIDO PRINCIPAL ====== -->
    <main class="py-5">
        <div class="app-container">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ====== Script modo oscuro ====== -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('darkModeToggle');
        const body = document.body;

        // Comprobar si hay modo oscuro guardado
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            updateToggleButton(true);
        }

        toggleButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            
            // Guardar preferencia
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                updateToggleButton(true);
            } else {
                localStorage.setItem('darkMode', 'disabled');
                updateToggleButton(false);
            }
        });

        function updateToggleButton(isDarkMode) {
            const icon = toggleButton.querySelector('i');
            const text = toggleButton.querySelector('span');
            
            if (isDarkMode) {
                icon.className = 'bi bi-sun-fill';
                text.textContent = 'Claro';
            } else {
                icon.className = 'bi bi-moon-fill';
                text.textContent = 'Oscuro';
            }
        }
    });
    </script>
</body>
</html>
