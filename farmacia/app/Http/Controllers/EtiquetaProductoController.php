<?php

namespace App\Http\Controllers;

use App\Models\EtiquetaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class EtiquetaProductoController extends Controller
{
    // Mostrar todas las etiquetas
    public function index()
    {
        $etiquetas = EtiquetaProducto::with('producto')->get();
        return view('etiquetas-productos.index', compact('etiquetas'));
    }

    // ✅ Mostrar formulario para crear una nueva etiqueta
    public function create()
    {
        $productos = Producto::all();
        return view('etiquetas-productos.create', compact('productos'));
    }

    // Guardar nueva etiqueta
    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'codigo_barras' => 'required|string|max:50',
        ]);

        EtiquetaProducto::create([
            'id_producto' => $request->id_producto,
            'codigo_barras' => $request->codigo_barras,
        ]);

        return redirect()->route('etiquetas-productos.index')
                         ->with('success', 'Etiqueta generada correctamente.');
    }

    // Mostrar una etiqueta específica
    public function show($id)
    {
        $etiqueta = EtiquetaProducto::with('producto')->findOrFail($id);
        return view('etiquetas-productos.show', compact('etiqueta'));
    }

    // Mostrar formulario para editar una etiqueta
    public function edit($id)
    {
        $etiqueta = EtiquetaProducto::findOrFail($id);
        $productos = Producto::all();
        return view('etiquetas-productos.edit', compact('etiqueta', 'productos'));
    }

    // Actualizar etiqueta existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'codigo_barras' => 'required|string|max:50',
        ]);

        $etiqueta = EtiquetaProducto::findOrFail($id);
        $etiqueta->update([
            'id_producto' => $request->id_producto,
            'codigo_barras' => $request->codigo_barras,
        ]);

        return redirect()->route('etiquetas-productos.index')
                         ->with('success', 'Etiqueta actualizada correctamente.');
    }

    // Eliminar etiqueta
    public function destroy($id)
    {
        $etiqueta = EtiquetaProducto::findOrFail($id);
        $etiqueta->delete();

        return redirect()->route('etiquetas-productos.index')
                         ->with('success', 'Etiqueta eliminada correctamente.');
    }
}
