<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Dompdf\Dompdf;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with(['cliente', 'usuario', 'detalles.producto'])->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $productos = Producto::all();
        $usuarioActual = auth()->user();

        // Asegurarse de que los productos incluyan el precio para el JavaScript
        $productosConPrecio = $productos->map(function($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio
            ];
        });

        return view('facturas.create', compact('clientes', 'usuarios', 'productos', 'productosConPrecio', 'usuarioActual'));
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

        $detalles = collect($validatedFactura['detalles'])->map(function ($detalle) {
            $cantidad = (int) $detalle['cantidad'];
            $precio = (float) $detalle['precio_unitario'];
            return [
                'id_producto' => $detalle['producto_id'],
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $cantidad * $precio,
            ];
        });

        $factura = null;

        DB::transaction(function () use (&$factura, $validatedFactura, $detalles) {
            $productoIds = $detalles->pluck('id_producto')->unique()->all();
            $productos = Producto::whereIn('id', $productoIds)->lockForUpdate()->get()->keyBy('id');
            $stockLevels = [];

            foreach ($productos as $producto) {
                $stockLevels[$producto->id] = (int) ($producto->stock ?? 0);
            }

            foreach ($detalles->values() as $index => $detalle) {
                $productoId = $detalle['id_producto'];

                if (!isset($stockLevels[$productoId])) {
                    throw ValidationException::withMessages([
                        "detalles.$index.producto_id" => 'El producto seleccionado no está disponible.'
                    ]);
                }

                if ($stockLevels[$productoId] < $detalle['cantidad']) {
                    throw ValidationException::withMessages([
                        "detalles.$index.cantidad" => 'Stock insuficiente para ' . ($productos[$productoId]->nombre ?? 'el producto seleccionado') . '.'
                    ]);
                }

                $stockLevels[$productoId] -= $detalle['cantidad'];
            }

            $factura = Factura::create([
                'id_cliente' => $validatedFactura['id_cliente'],
                'id_usuario' => $validatedFactura['id_usuario'],
                'total' => $validatedFactura['total'],
                'enviada_por_correo' => (bool) $validatedFactura['enviada_por_correo'],
            ]);

            $factura->detalles()->createMany($detalles->toArray());

            foreach ($stockLevels as $productoId => $nuevoStock) {
                $producto = $productos[$productoId];
                $producto->stock = $nuevoStock;
                $producto->save();
            }
        });

        return redirect()->route('facturas.index')->with('success', 'Factura y detalles creados correctamente.');
    }

    public function edit(Factura $factura)
    {
        $factura->load('detalles.producto');
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $productos = Producto::all();
        $usuarioActual = auth()->user();

        // Asegurarse de que los productos incluyan el precio para el JavaScript
        $productosConPrecio = $productos->map(function($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio
            ];
        });

        return view('facturas.edit', compact('factura', 'clientes', 'usuarios', 'productos', 'productosConPrecio', 'usuarioActual'));
    }

    public function update(Request $request, Factura $factura)
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

        $detalles = collect($validatedFactura['detalles'])->map(function ($detalle) {
            $cantidad = (int) $detalle['cantidad'];
            $precio = (float) $detalle['precio_unitario'];
            return [
                'id_producto' => $detalle['producto_id'],
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $cantidad * $precio,
            ];
        });

        $factura->load('detalles');

        DB::transaction(function () use ($factura, $validatedFactura, $detalles) {
            $productoIds = $detalles->pluck('id_producto')
                ->merge($factura->detalles->pluck('id_producto'))
                ->unique()
                ->all();

            $productos = Producto::whereIn('id', $productoIds)->lockForUpdate()->get()->keyBy('id');
            $stockLevels = [];

            foreach ($productos as $producto) {
                $stockLevels[$producto->id] = (int) ($producto->stock ?? 0);
            }

            foreach ($factura->detalles as $detalleAnterior) {
                $productoId = $detalleAnterior->id_producto;

                if (isset($stockLevels[$productoId])) {
                    $stockLevels[$productoId] += (int) $detalleAnterior->cantidad;
                }
            }

            foreach ($detalles->values() as $index => $detalle) {
                $productoId = $detalle['id_producto'];

                if (!isset($stockLevels[$productoId])) {
                    throw ValidationException::withMessages([
                        "detalles.$index.producto_id" => 'El producto seleccionado no está disponible.'
                    ]);
                }

                if ($stockLevels[$productoId] < $detalle['cantidad']) {
                    throw ValidationException::withMessages([
                        "detalles.$index.cantidad" => 'Stock insuficiente para ' . ($productos[$productoId]->nombre ?? 'el producto seleccionado') . '.'
                    ]);
                }

                $stockLevels[$productoId] -= $detalle['cantidad'];
            }

            $factura->update([
                'id_cliente' => $validatedFactura['id_cliente'],
                'id_usuario' => $validatedFactura['id_usuario'],
                'total' => $validatedFactura['total'],
                'enviada_por_correo' => (bool) $validatedFactura['enviada_por_correo'],
            ]);

            $factura->detalles()->delete();
            $factura->detalles()->createMany($detalles->toArray());

            foreach ($stockLevels as $productoId => $nuevoStock) {
                $producto = $productos[$productoId];
                $producto->stock = $nuevoStock;
                $producto->save();
            }
        });

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy(Factura $factura)
    {
        $factura->detalles()->delete();
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }

    public function report()
    {
        $facturas = Factura::with(['cliente', 'usuario', 'detalles.producto'])->orderByDesc('created_at')->get();
        
        // Render the view to HTML
        $html = view('pdf.facturas-reporte', [
            'facturas' => $facturas,
        ])->render();
        
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        
        // Set options
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size
        $dompdf->setPaper('a4');
        
        // Render the PDF
        $dompdf->render();
        
        // Stream the PDF
        return $dompdf->stream('reporte_facturas.pdf', [
            'Attachment' => false
        ]);
    }

    public function download(Factura $factura)
    {
        $factura->load(['cliente', 'usuario', 'detalles.producto']);
        
        // Render the view to HTML
        $html = view('pdf.factura-individual', [
            'factura' => $factura,
        ])->render();
        
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        
        // Set options
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size
        $dompdf->setPaper('a4');
        
        // Render the PDF
        $dompdf->render();
        
        // Stream the PDF
        return $dompdf->stream('factura_'.$factura->id.'.pdf', [
            'Attachment' => false
        ]);
    }
}
