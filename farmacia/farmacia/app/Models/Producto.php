<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'proveedor',
        'unidad_medida',
        'precio_compra',
        'precio_venta',
        'stock',
        'imagen',
        'estado'
    ];

    // Relación con detalle de facturas
    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'id_producto');
    }

    // Relación con inventario
    public function movimientosInventario()
    {
        return $this->hasMany(InventarioMovimiento::class, 'id_producto');
    }

    // Relación con etiquetas
    public function etiquetas()
    {
        return $this->hasMany(EtiquetaProducto::class, 'id_producto');
    }
}
