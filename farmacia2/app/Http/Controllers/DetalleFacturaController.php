<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        // Listar todos los detalles (opcional, o puedes listarlos dentro de la factura)
        $detalles = DetalleFactura::with('producto', 'factura')->get();
        return view('detalle-factura.index', compact('detalles'));
    }

    public function create()
    {
        $facturas = Factura::all();
        $productos = Producto::all();
        return view('detalle-factura.create', compact('facturas', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_factura' => 'required|exists:facturas,id',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $subtotal = $request->cantidad * $request->precio_unitario;

        DetalleFactura::create([
            'id_factura' => $request->id_factura,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('detalle-factura.index')->with('success', 'Detalle creado correctamente.');
    }

    public function edit($id)
    {
        $detalle = DetalleFactura::findOrFail($id);
        $facturas = Factura::all();
        $productos = Producto::all();
        return view('detalle-factura.edit', compact('detalle', 'facturas', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleFactura::findOrFail($id);

        $request->validate([
            'id_factura' => 'required|exists:facturas,id',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $subtotal = $request->cantidad * $request->precio_unitario;

        $detalle->update([
            'id_factura' => $request->id_factura,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('detalle-factura.index')->with('success', 'Detalle actualizado correctamente.');
    }

    public function destroy($id)
    {
        $detalle = DetalleFactura::findOrFail($id);
        $detalle->delete();

        return redirect()->route('detalle-factura.index')->with('success', 'Detalle eliminado correctamente.');
    }
}
