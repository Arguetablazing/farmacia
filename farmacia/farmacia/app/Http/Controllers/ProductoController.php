<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('rol:Administrador,Cajero')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Procesar la imagen si se ha subido
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('uploads/productos'), $nombreImagen);
            $data['imagen'] = 'uploads/productos/' . $nombreImagen;
        }

        $producto = Producto::create($data);
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Procesar la imagen si se ha subido
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }
            
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('uploads/productos'), $nombreImagen);
            $data['imagen'] = 'uploads/productos/' . $nombreImagen;
        }

        // Actualizar los datos del producto
        $producto->update($data);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}

