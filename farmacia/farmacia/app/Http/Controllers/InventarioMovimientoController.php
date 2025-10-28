<?php

namespace App\Http\Controllers;

use App\Models\InventarioMovimiento;
use App\Models\Producto;
use App\Models\Usuario; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class InventarioMovimientoController extends Controller
{
    // Mostrar todos los movimientos con relaciones cargadas
    public function index()
    {
        $movimientos = InventarioMovimiento::with(['producto', 'usuario'])->get();
        return view('inventario-movimientos.index', compact('movimientos'));
    }

    // Mostrar formulario para crear un nuevo movimiento
    public function create()
    {
        $productos = Producto::all();
        $usuarios = Usuario::all();
        return view('inventario-movimientos.create', compact('productos', 'usuarios'));
    }

    // Guardar nuevo movimiento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'tipo_movimiento' => 'required|in:entrada,salida,devolución,recepción',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        InventarioMovimiento::create($validated);

        return redirect()->route('inventario-movimientos.index')->with('success', 'Movimiento creado correctamente.');
    }

    // Mostrar detalles de un movimiento
    public function show(InventarioMovimiento $inventario_movimiento)
    {
        return view('inventario-movimientos.show', compact('inventario_movimiento'));
    }

    // Mostrar formulario de edición
    public function edit(InventarioMovimiento $inventario_movimiento)
    {
        $productos = Producto::all();
        $usuarios = Usuario::all();
        return view('inventario-movimientos.edit', compact('inventario_movimiento', 'productos', 'usuarios'));
    }

    // Actualizar movimiento
    public function update(Request $request, InventarioMovimiento $inventario_movimiento)
    {
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'tipo_movimiento' => 'required|in:entrada,salida,devolución,recepción',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $inventario_movimiento->update($validated);

        return redirect()->route('inventario-movimientos.index')->with('success', 'Movimiento actualizado correctamente.');
    }

    // Eliminar movimiento
    public function destroy(InventarioMovimiento $inventario_movimiento)
    {
        $inventario_movimiento->delete();
        return redirect()->route('inventario-movimientos.index')->with('success', 'Movimiento eliminado correctamente.');
    }
}
