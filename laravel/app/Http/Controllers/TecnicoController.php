<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use App\Models\Usuario;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnico::with(['usuario', 'especialidad'])->get();

        return view('tecnicos.index', compact('tecnicos'));
    }

   public function create()
    {
        $usuarios = Usuario::where('rol', 'particular')->get();
     $especialidades = Especialidad::all();

        return view('tecnicos.create', compact('usuarios', 'especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|integer',
            'disponible' => 'required|boolean'
        ]);

        Tecnico::create([
            'usuario_id' => $request->usuario_id,
            'nombre_completo' => $request->nombre_completo,
            'especialidad_id' => $request->especialidad_id,
            'disponible' => $request->disponible
        ]);

        return redirect()->route('tecnicos.index');
    }

        public function edit($id)
    {
        $tecnico = Tecnico::findOrFail($id);
        $usuarios = Usuario::where('rol', 'particular')->get();
        $especialidades = Especialidad::all();

        return view('tecnicos.edit', compact('tecnico', 'usuarios', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|integer',
            'disponible' => 'required|boolean'
        ]);

        $tecnico = Tecnico::findOrFail($id);

        $tecnico->update([
            'usuario_id' => $request->usuario_id,
            'nombre_completo' => $request->nombre_completo,
            'especialidad_id' => $request->especialidad_id,
            'disponible' => $request->disponible
        ]);

        return redirect()->route('tecnicos.index');
    }

    public function destroy($id)
    {
        $tecnico = Tecnico::findOrFail($id);
        $tecnico->delete();

        return redirect()->route('tecnicos.index');
    }
}