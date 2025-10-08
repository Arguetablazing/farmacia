<?php

namespace App\Http\Controllers;

use App\Models\EtiquetaProducto;
use Illuminate\Http\Request;

class EtiquetaProductoController extends Controller
{
    public function index()
    {
        $etiquetas = EtiquetaProducto::all();
        return view('etiquetas-productos.index', compact('etiquetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'codigo_barras' => 'required|string|max:50'
        ]);

        $etiqueta = EtiquetaProducto::create($request->all());
        return response()->json($etiqueta, 201);
    }

    public function show($id)
    {
        return response()->json(EtiquetaProducto::with('producto')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $etiqueta = EtiquetaProducto::findOrFail($id);
        $etiqueta->update($request->all());
        return response()->json($etiqueta);
    }

    public function destroy($id)
    {
        EtiquetaProducto::destroy($id);
        return response()->json(['message' => 'Etiqueta eliminada']);
    }
}
