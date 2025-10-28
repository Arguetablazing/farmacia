<?php

namespace App\Http\Controllers;

use App\Models\RolPermiso;
use Illuminate\Http\Request;

class RolPermisoController extends Controller
{
    public function index()
    {
        $rolesPermisos = RolPermiso::all();
        return view('roles-permisos.index', compact('rolesPermisos'));
    }

    public function create()
    {
        return view('roles-permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required|string',
            'funcionalidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        RolPermiso::create($request->all());

        return redirect()->route('roles-permisos.index')->with('success', 'Permiso asignado correctamente.');
    }

    public function edit($id)
    {
        $rolPermiso = RolPermiso::findOrFail($id);
        return view('roles-permisos.edit', compact('rolPermiso'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|string',
            'funcionalidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $rolPermiso = RolPermiso::findOrFail($id);
        $rolPermiso->update($request->all());

        return redirect()->route('roles-permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy($id)
    {
        RolPermiso::destroy($id);
        return redirect()->route('roles-permisos.index')->with('success', 'Permiso eliminado.');
    }
}
