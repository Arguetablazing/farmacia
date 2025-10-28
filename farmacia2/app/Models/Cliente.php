<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion'
    ];

    // Un cliente puede tener muchas facturas
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_cliente');
    }
}
