<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\InventarioMovimientoController;
use App\Http\Controllers\EtiquetaProductoController;
use App\Http\Controllers\RolPermisoController;
use App\Http\Controllers\BitacoraOperacionController;


Route::resource('usuarios', UsuarioController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class);
Route::resource('facturas', FacturaController::class);
Route::resource('detalle-factura', DetalleFacturaController::class);
Route::resource('inventario-movimientos', InventarioMovimientoController::class);
Route::resource('etiquetas-productos', EtiquetaProductoController::class);
Route::resource('roles-permisos', RolPermisoController::class);
Route::resource('bitacora-operaciones', BitacoraOperacionController::class);
