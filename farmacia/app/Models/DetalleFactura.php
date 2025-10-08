<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalle_factura';  // Nombre exacto de la tabla en la DB

    protected $fillable = [
        'id_factura',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Relación con la factura (opcional si la necesitas)
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}
