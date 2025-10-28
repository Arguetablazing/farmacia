<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraOperacion extends Model
{
    use HasFactory;

    protected $table = 'bitacora_operaciones';

    protected $fillable = [
        'id_usuario',
        'operacion',
        'fecha'
    ];

    // Para que Laravel convierta 'fecha' a instancia de Carbon automáticamente
    protected $casts = [
        'fecha' => 'datetime',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
