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
        ]);

        $codigoBarras = $this->generateUniqueBarcode();

        $etiqueta = EtiquetaProducto::create([
            'id_producto' => $request->id_producto,
            'codigo_barras' => $codigoBarras,
        ]);

        return redirect()->route('etiquetas-productos.index')
                         ->with([
                             'success' => 'Etiqueta generada correctamente.',
                             'barcode_url' => route('etiquetas-productos.barcode', $etiqueta->id),
                             'barcode_id' => $etiqueta->id,
                         ]);
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
        ]);

        $etiqueta = EtiquetaProducto::findOrFail($id);
        $etiqueta->update([
            'id_producto' => $request->id_producto,
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

    public function barcode(EtiquetaProducto $etiqueta)
    {
        if (!$etiqueta->codigo_barras) {
            return redirect()->route('etiquetas-productos.index')
                             ->with('error', 'La etiqueta no tiene un código de barras asignado.');
        }

        $barcodeUrl = 'https://barcode.tec-it.com/barcode.ashx?data=' . urlencode($etiqueta->codigo_barras) . '&code=Code128&translate-esc=true';

        return redirect()->away($barcodeUrl);
    }

    protected function generateUniqueBarcode(): string
    {
        do {
            // Genera un número aleatorio de 12 dígitos (similar a EAN-13 sin dígito de verificación)
            $codigo = str_pad((string) random_int(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (EtiquetaProducto::where('codigo_barras', $codigo)->exists());

        return $codigo;
    }
}
