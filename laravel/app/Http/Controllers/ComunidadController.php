<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Gestora;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    // Listado de todas las comunidades
    public function index()
    {
        $comunidades = Comunidad::with('gestora')->get();

        return view('comunidades.index', compact('comunidades'));
    }

    // Formulario para crear una comunidad nueva
    public function create()
    {
        $gestoras = Gestora::all();

        return view('comunidades.create', compact('gestoras'));
    }

    // Guardar la comunidad nueva
    public function store(Request $request)
    {
        $request->validate([
            'gestora_id' => 'required|exists:gestoras,id',
            'nombre'     => 'required|string|max:255',
            'direccion'  => 'required|string|max:255',
            'zona'       => 'required|string|max:100',
        ]);

        Comunidad::create([
            'gestora_id' => $request->gestora_id,
            'nombre'     => $request->nombre,
            'direccion'  => $request->direccion,
            'zona'       => $request->zona,
        ]);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad creada correctamente.');
    }

    // Formulario para editar
    public function edit($id)
    {
        $comunidad = Comunidad::findOrFail($id);
        $gestoras  = Gestora::all();

        return view('comunidades.edit', compact('comunidad', 'gestoras'));
    }

    // Guardar cambios
    public function update(Request $request, $id)
    {
        $comunidad = Comunidad::findOrFail($id);

        $request->validate([
            'gestora_id' => 'required|exists:gestoras,id',
            'nombre'     => 'required|string|max:255',
            'direccion'  => 'required|string|max:255',
            'zona'       => 'required|string|max:100',
        ]);

        $comunidad->update([
            'gestora_id' => $request->gestora_id,
            'nombre'     => $request->nombre,
            'direccion'  => $request->direccion,
            'zona'       => $request->zona,
        ]);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada.');
    }

    // Eliminar
    public function destroy($id)
    {
        $comunidad = Comunidad::findOrFail($id);
        $comunidad->delete();

        return redirect()->route('comunidades.index')->with('success', 'Comunidad eliminada.');
    }
}
