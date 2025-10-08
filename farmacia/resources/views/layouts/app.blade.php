<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema Farmacia</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 240px;
            background-color: #1e1e2f;
            color: #cfd8dc;
            padding-top: 60px;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: #cfd8dc;
            padding: 12px 20px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }

        /* Top Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 60px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            transition: left 0.3s ease;
        }

        .navbar.collapsed {
            left: 70px;
        }

        .navbar .btn-toggle-sidebar {
            margin-right: 15px;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            margin-top: 60px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 70px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: #f1f1f1;
        }

        body.dark-mode .navbar {
            background-color: #1e1e2f;
            border-color: #333;
        }

        body.dark-mode .sidebar {
            background-color: #111;
            color: #ccc;
        }

        body.dark-mode .nav-link {
            color: #bbb;
        }

        body.dark-mode .nav-link:hover,
        body.dark-mode .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        body.dark-mode .main-content {
            background-color: #1e1e2f;
        }

        body.dark-mode .card {
            background-color: #2c2c3e;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -240px;
            }

            .sidebar.collapsed {
                left: 0;
                width: 240px;
            }

            .navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}"><i class="bi bi-people"></i> <span>Usuarios</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}"><i class="bi bi-person-badge"></i> <span>Clientes</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}"><i class="bi bi-box-seam"></i> <span>Productos</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('facturas.index') }}"><i class="bi bi-receipt"></i> <span>Facturas</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('detalle-factura.index') }}"><i class="bi bi-file-earmark-text"></i> <span>Detalle</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('inventario-movimientos.index') }}"><i class="bi bi-layers"></i> <span>Inventario</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('etiquetas-productos.index') }}"><i class="bi bi-tags"></i> <span>Etiquetas</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('roles-permisos.index') }}"><i class="bi bi-shield-lock"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('bitacora-operaciones.index') }}"><i class="bi bi-journal-text"></i> <span>Bitácora</span></a></li>
    </ul>
</div>

<!-- Navbar superior -->
<nav id="navbar" class="navbar shadow-sm">
    <button class="btn btn-outline-secondary btn-sm btn-toggle-sidebar" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <span class="navbar-brand mb-0 h5 me-auto">Sistema de Farmacia</span>
    <button class="btn btn-outline-dark btn-sm" onclick="toggleDarkMode()">
        <i class="bi bi-moon"></i> <span class="d-none d-md-inline">Modo Oscuro</span>
    </button>
</nav>

<!-- Contenido principal -->
<div id="main-content" class="main-content">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Funcionalidad sidebar y dark mode -->
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.getElementById('navbar').classList.toggle('collapsed');
        document.getElementById('main-content').classList.toggle('collapsed');
    }

    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
</script>

</body>
</html>
