<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
    'nombre',
    'correo',
    'contraseña',
    'rol',
    'estado',
    'imagen',
];

    protected $hidden = [
        'contraseña',
    ];

    // Esto le indica a Laravel que el campo de contraseña se llama "contraseña"
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
