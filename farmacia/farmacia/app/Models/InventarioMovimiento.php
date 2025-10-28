<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioMovimiento extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue convención)
    protected $table = 'inventario_movimientos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad',
        'motivo',
        'fecha',
        'id_usuario'
    ];

    // Castings opcionales para asegurar tipos de datos
    protected $casts = [
        'cantidad' => 'integer',
        'fecha' => 'datetime',
    ];

    /**
     * Relación: Un movimiento pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    /**
     * Relación: Un movimiento fue realizado por un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
