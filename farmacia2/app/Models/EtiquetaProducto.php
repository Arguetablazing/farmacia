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
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_generada' => 'datetime',
    ];

    protected $appends = ['barcode_url'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function getBarcodeUrlAttribute(): ?string
    {
        if (!$this->codigo_barras) {
            return null;
        }

        return route('etiquetas-productos.barcode', $this->id);
    }
}
