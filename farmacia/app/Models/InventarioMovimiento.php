<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioMovimiento extends Model
{
    use HasFactory;

    protected $table = 'inventario_movimientos';
    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad',
        'motivo',
        'fecha',
        'id_usuario'
    ];

    // Movimiento pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Movimiento pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
