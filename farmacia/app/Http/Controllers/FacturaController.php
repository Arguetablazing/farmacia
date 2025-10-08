<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        // Carga cliente, usuario, detalles y productos para evitar consultas N+1
        $facturas = Factura::with(['cliente', 'usuario', 'detalles.producto'])->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $productos = \App\Models\Producto::all();

        return view('facturas.create', compact('clientes', 'usuarios', 'productos'));
    }

    public function store(Request $request)
    {
        $validatedFactura = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'total' => 'required|numeric|min:0',
            'enviada_por_correo' => 'required|boolean',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|integer|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Crear factura
        $factura = Factura::create([
            'id_cliente' => $validatedFactura['id_cliente'],
            'id_usuario' => $validatedFactura['id_usuario'],
            'total' => $validatedFactura['total'],
            'enviada_por_correo' => $validatedFactura['enviada_por_correo'],
        ]);

        // Crear detalles
        foreach ($validatedFactura['detalles'] as $detalle) {
            $factura->detalles()->create([
                'id_producto' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
                'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
            ]);
        }

        return redirect()->route('facturas.index')->with('success', 'Factura y detalles creados correctamente.');
    }

    public function destroy(Factura $factura)
    {
        // Eliminar detalles primero para evitar conflictos de integridad referencial
        $factura->detalles()->delete();

        // Eliminar factura
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }
}
