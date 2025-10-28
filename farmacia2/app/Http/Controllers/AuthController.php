<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario || !Hash::check($request->contraseña, $usuario->contraseña)) {
            return back()->withErrors(['correo' => 'Credenciales incorrectas'])->withInput();
        }

        Auth::login($usuario);

        // Roles permitidos para el dashboard
        $rolesPermitidos = ['Administrador','Cajero','Empleado','Supervisor'];

        if (!in_array($usuario->rol, $rolesPermitidos)) {
            Auth::logout();
            return back()->withErrors(['correo' => 'Acceso restringido'])->withInput();
        }

        // Redirige al dashboard único
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
