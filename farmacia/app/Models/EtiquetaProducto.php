<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetaProducto extends Model
{
    use HasFactory;

    protected $table = 'etiquetas_productos';
    protected $fillable = [
        'id_producto',
        'codigo_barras',
        'fecha_generada'
    ];

    // Etiqueta pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
