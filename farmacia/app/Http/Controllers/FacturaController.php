<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Mostrar todas las facturas
    public function index()
    {
        $facturas = Factura::with(['cliente', 'usuario'])->get();
        return view('facturas.index', compact('facturas'));
    }

    // Mostrar formulario para crear factura
    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('facturas.create', compact('clientes', 'usuarios'));
    }

    // Guardar nueva factura
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'enviada_por_correo' => 'required|boolean',
        ]);

        Factura::create([
            'id_cliente' => $validated['id_cliente'],
            'id_usuario' => $validated['id_usuario'],
            'total' => $validated['total'],
            'enviada_por_correo' => $validated['enviada_por_correo'],
        ]);

        return redirect()->route('facturas.index')->with('success', 'Factura creada correctamente.');
    }

    // Mostrar una factura específica
    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    // Mostrar formulario para editar factura
    public function edit(Factura $factura)
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('facturas.edit', compact('factura', 'clientes', 'usuarios'));
    }

    // Actualizar factura
    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'enviada_por_correo' => 'required|boolean',
        ]);

        $factura->update($validated);

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    // Eliminar factura
    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }
}
