{{-- resources/views/bitacora-operaciones/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Bitácora de Operaciones')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Bitácora de Operaciones</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($bitacoras->isEmpty())
        <p class="text-gray-600">No hay operaciones registradas en la bitácora.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Usuario</th>
                        <th class="py-2 px-4 border-b">Acción</th>
                        <th class="py-2 px-4 border-b">Descripción</th>
                        <th class="py-2 px-4 border-b">Fecha</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @foreach($bitacoras as $bitacora)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-center">{{ $bitacora->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $bitacora->usuario }}</td>
                            <td class="py-2 px-4 border-b">{{ $bitacora->accion }}</td>
                            <td class="py-2 px-4 border-b">{{ $bitacora->descripcion }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($bitacora->fecha)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación, si la usas --}}
        <div class="mt-4">
            {{ $bitacoras->links() }}
        </div>
    @endif
</div>
@endsection
