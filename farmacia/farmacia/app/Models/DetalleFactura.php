<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    // Especifica el nombre exacto de la tabla
    protected $table = 'detalle_factura';

    protected $fillable = [
        'id_factura',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con factura
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
