<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'contraseña' => 'required|string|min:6',
            'rol' => 'required|in:Funcionario,Empleado,Cajero,Administrador,Supervisor',
            'estado' => 'sometimes|boolean',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => bcrypt($request->contraseña),
            'rol' => $request->rol,
            'estado' => $request->has('estado') ? 1 : 0,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => "required|email|unique:usuarios,correo,$id",
            'rol' => 'required|in:Funcionario,Empleado,Cajero,Administrador,Supervisor',
            'estado' => 'sometimes|boolean',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'rol' => $request->rol,
            'estado' => $request->has('estado') ? 1 : 0,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
