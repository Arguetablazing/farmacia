<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    protected function authorizeModification()
    {
        $rol = strtolower(auth()->user()->rol ?? '');
        abort_unless(in_array($rol, ['administrador', 'cajero']), 403, 'No autorizado para modificar usuarios');
    }

    // Mostrar formulario de creación
    public function create()
    {
        $this->authorizeModification();
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $this->authorizeModification();

        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'contraseña' => 'required|string|min:6|confirmed',
            'rol' => 'required|in:Empleado,Cajero,Administrador,Supervisor',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            // estado ya no se valida como boolean para evitar errores
        ]);

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => bcrypt($request->contraseña),
            'rol' => $request->rol,
            'estado' => $request->has('estado') ? 1 : 0, // convierte checkbox a 1 o 0
        ];

        // Subir imagen si se envía
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('usuarios', 'public');
        }

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $this->authorizeModification();

        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario existente
    public function update(Request $request, $id)
    {
        $this->authorizeModification();

        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => "required|email|unique:usuarios,correo,{$id}",
            'rol' => 'required|in:Empleado,Cajero,Administrador,Supervisor',
            'contraseña' => 'nullable|string|min:6|confirmed',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            // estado ya no se valida como boolean
        ]);

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'rol' => $request->rol,
            'estado' => $request->has('estado') ? 1 : 0,
        ];

        // Solo actualiza la contraseña si se ingresa una nueva
        if ($request->filled('contraseña')) {
            $data['contraseña'] = bcrypt($request->contraseña);
        }

        // Subir nueva imagen si se envía
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($usuario->imagen && Storage::disk('public')->exists($usuario->imagen)) {
                Storage::disk('public')->delete($usuario->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('usuarios', 'public');
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $this->authorizeModification();

        $usuario = Usuario::findOrFail($id);

        // Eliminar imagen si existe
        if ($usuario->imagen && Storage::disk('public')->exists($usuario->imagen)) {
            Storage::disk('public')->delete($usuario->imagen);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
