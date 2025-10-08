<?php

namespace App\Http\Controllers;

use App\Models\BitacoraOperacion;
use Illuminate\Http\Request;

class BitacoraOperacionController extends Controller
{
    public function index()
    {
        // Trae bitácoras con la relación usuario y ordenadas por fecha descendente, paginadas
        $bitacoras = BitacoraOperacion::with('usuario')
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('bitacora-operaciones.index', compact('bitacoras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'operacion' => 'required|string',
        ]);

        $bitacora = BitacoraOperacion::create($request->all());
        return response()->json($bitacora, 201);
    }

    public function show($id)
    {
        return response()->json(BitacoraOperacion::with('usuario')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $bitacora = BitacoraOperacion::findOrFail($id);
        $bitacora->update($request->all());
        return response()->json($bitacora);
    }

    public function destroy($id)
    {
        BitacoraOperacion::destroy($id);
        return response()->json(['message' => 'Registro de bitácora eliminado']);
    }
}
