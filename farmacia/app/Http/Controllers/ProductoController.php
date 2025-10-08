<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_compra' => 'nullable|numeric',
            'precio_venta' => 'nullable|numeric',
            'stock' => 'nullable|integer',
        ]);

        $producto = Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function show($id)
    {
        return response()->json(Producto::findOrFail($id));
    }

    public function edit($id)
    {
        // Obtener el producto con el ID especificado
        $producto = Producto::findOrFail($id);
        // Mostrar el formulario de edición con el producto
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_compra' => 'nullable|numeric',
            'precio_venta' => 'nullable|numeric',
            'stock' => 'nullable|integer',
        ]);

        // Actualizar los datos del producto
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}

