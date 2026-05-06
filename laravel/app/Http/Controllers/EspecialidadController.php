<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::all();

        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_especialidad' => 'required|string|max:100'
        ]);

        Especialidad::create([
            'nombre_especialidad' => $request->nombre_especialidad
        ]);

        return redirect()->route('especialidades.index');
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_especialidad' => 'required|string|max:100'
        ]);

        $especialidad = Especialidad::findOrFail($id);

        $especialidad->update([
            'nombre_especialidad' => $request->nombre_especialidad
        ]);

        return redirect()->route('especialidades.index');
    }
    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        $especialidad->delete();

        return redirect()->route('especialidades.index');
    }
}