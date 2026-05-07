<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Tecnico;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::orderBy('id')->get();

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

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad creada correctamente.');
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::findOrFail($id);

        $request->validate([
            'nombre_especialidad' => 'required|string|max:100'
        ]);

        $especialidad->update([
            'nombre_especialidad' => $request->nombre_especialidad
        ]);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        $tecnicosAsociados = Tecnico::where('especialidad_id', $especialidad->id)->count();
        $incidenciasAsociadas = Incidencia::where('especialidad_id', $especialidad->id)->count();

        if ($tecnicosAsociados > 0) {
            return redirect()
                ->route('especialidades.index')
                ->with('error', 'No se puede eliminar esta especialidad porque hay técnicos asociados a ella. Primero habría que reasignar esos técnicos a otra especialidad.');
        }

        if ($incidenciasAsociadas > 0) {
            return redirect()
                ->route('especialidades.index')
                ->with('error', 'No se puede eliminar esta especialidad porque hay incidencias asociadas a ella. Para mantener la trazabilidad, primero habría que reasignar o eliminar esas incidencias.');
        }

        try {
            $especialidad->delete();

            return redirect()
                ->route('especialidades.index')
                ->with('success', 'Especialidad eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()
                ->route('especialidades.index')
                ->with('error', 'No se puede eliminar esta especialidad porque está relacionada con otros datos del sistema.');
        }
    }
}