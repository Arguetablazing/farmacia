<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['id_cliente', 'id_usuario', 'total', 'enviada_por_correo'];

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'id_factura');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
