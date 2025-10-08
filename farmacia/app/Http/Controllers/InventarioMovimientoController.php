<?php

namespace App\Http\Controllers;

use App\Models\InventarioMovimiento;
use Illuminate\Http\Request;

class InventarioMovimientoController extends Controller
{
    public function index()
    {
        $movimientos = InventarioMovimiento::all();
        return view('inventario-movimientos.index', compact('movimientos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'tipo_movimiento' => 'required|in:entrada,salida,devolución,recepción',
            'cantidad' => 'required|integer|min:0',
            'id_usuario' => 'nullable|exists:usuarios,id'
        ]);

        $movimiento = InventarioMovimiento::create($request->all());
        return response()->json($movimiento, 201);
    }

    public function show($id)
    {
        return response()->json(InventarioMovimiento::with(['producto', 'usuario'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $movimiento = InventarioMovimiento::findOrFail($id);
        $movimiento->update($request->all());
        return response()->json($movimiento);
    }

    public function destroy($id)
    {
        InventarioMovimiento::destroy($id);
        return response()->json(['message' => 'Movimiento de inventario eliminado']);
    }
}
