<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\InventarioMovimientoController;
use App\Http\Controllers\EtiquetaProductoController;
use App\Http\Controllers\BitacoraOperacionController;
use App\Http\Controllers\RolPermisoController;

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS POR AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 📊 DASHBOARDS POR ROL
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['rol:Administrador,Empleado,Cajero,Supervisor'])->group(function () {
        Route::get('/dashboard-empleado', function () {
            return view('dashboard');
        })->name('dashboard.empleado');
    
        Route::get('/dashboard-supervisor', function () {
            return view('dashboard');
        })->name('dashboard.supervisor');
    
        Route::get('/dashboard-cajero', function () {
            return view('dashboard');
        })->name('dashboard.cajero');
    });

    Route::middleware(['rol:Administrador,Supervisor,Cajero'])->group(function () {
        Route::get('facturas/reporte', [FacturaController::class, 'report'])->name('facturas.report');
    });

    /*
    |--------------------------------------------------------------------------
    | RUTAS POR ROL
    |--------------------------------------------------------------------------
    */

    // 🔐 ADMINISTRADOR (gestión interna)
    Route::middleware(['rol:Administrador'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('roles-permisos', RolPermisoController::class);
        Route::resource('bitacora-operaciones', BitacoraOperacionController::class)->only(['index']);
    });

    // 🔹 LECTURA COMPARTIDA (Administrador, Cajero, Supervisor, Empleado)
    Route::middleware(['rol:Administrador,Cajero,Supervisor,Empleado'])->group(function () {
        Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
    });

    // 🔹 LECTURA COMPARTIDA (Administrador, Cajero, Supervisor)
    Route::middleware(['rol:Administrador,Cajero,Supervisor'])->group(function () {
        Route::get('facturas', [FacturaController::class, 'index'])->name('facturas.index');
        Route::get('facturas/{factura}/pdf', [FacturaController::class, 'download'])->name('facturas.download');
        Route::get('detalle-factura', [DetalleFacturaController::class, 'index'])->name('detalle-factura.index');
        Route::get('etiquetas-productos', [EtiquetaProductoController::class, 'index'])->name('etiquetas-productos.index');
    });

    // 🔹 SUPERVISOR (lectura adicional)
    Route::middleware(['rol:Supervisor'])->group(function () {
        Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    });

    // 🔹 ADMINISTRADOR y CAJERO (control completo)

    // 🔹 ADMINISTRADOR y CAJERO (control completo)
    Route::middleware(['rol:Administrador,Cajero'])->group(function () {
        Route::resource('clientes', ClienteController::class)->except(['index']);
        Route::resource('productos', ProductoController::class)->except(['index']);
        Route::resource('facturas', FacturaController::class)->except(['index']);
        Route::resource('detalle-factura', DetalleFacturaController::class)->except(['index']);
        Route::resource('inventario-movimientos', InventarioMovimientoController::class);
        Route::resource('etiquetas-productos', EtiquetaProductoController::class)->except(['index']);
        Route::get('etiquetas-productos/{etiqueta}/barcode', [EtiquetaProductoController::class, 'barcode'])->name('etiquetas-productos.barcode');
    });
});
