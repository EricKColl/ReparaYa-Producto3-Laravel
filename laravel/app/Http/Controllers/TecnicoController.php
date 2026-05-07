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
        $tecnicos = Tecnico::with(['usuario', 'especialidad'])
            ->orderBy('nombre_completo')
            ->get();

        return view('tecnicos.index', compact('tecnicos'));
    }

    public function create()
    {
        // Solo pueden convertirse en técnicos los usuarios con rol "tecnico"
        // y que todavía no tengan ficha creada en la tabla tecnicos.
        $usuarios = Usuario::where('rol', 'tecnico')
            ->whereDoesntHave('tecnico')
            ->orderBy('nombre')
            ->get();

        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();

        return view('tecnicos.create', compact('usuarios', 'especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|integer|exists:especialidades,id',
            'disponible' => 'required|boolean'
        ]);

        $usuario = Usuario::findOrFail($request->usuario_id);

        if ($usuario->rol !== 'tecnico') {
            return back()
                ->withErrors(['usuario_id' => 'Solo se puede crear una ficha técnica para usuarios con rol Técnico.'])
                ->withInput();
        }

        if (Tecnico::where('usuario_id', $usuario->id)->exists()) {
            return back()
                ->withErrors(['usuario_id' => 'Este usuario ya tiene una ficha de técnico asociada.'])
                ->withInput();
        }

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

        // En edición mostramos usuarios técnicos libres y el usuario actual del técnico editado.
        $usuarios = Usuario::where(function ($query) use ($tecnico) {
                $query->where('rol', 'tecnico')
                      ->whereDoesntHave('tecnico');
            })
            ->orWhere('id', $tecnico->usuario_id)
            ->orderBy('nombre')
            ->get();

        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();

        return view('tecnicos.edit', compact('tecnico', 'usuarios', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|integer|exists:especialidades,id',
            'disponible' => 'required|boolean'
        ]);

        $tecnico = Tecnico::findOrFail($id);
        $usuario = Usuario::findOrFail($request->usuario_id);

        if ($usuario->rol !== 'tecnico') {
            return back()
                ->withErrors(['usuario_id' => 'Solo se puede asociar una ficha técnica a usuarios con rol Técnico.'])
                ->withInput();
        }

        $yaExiste = Tecnico::where('usuario_id', $usuario->id)
            ->where('id', '!=', $tecnico->id)
            ->exists();

        if ($yaExiste) {
            return back()
                ->withErrors(['usuario_id' => 'Este usuario ya está asociado a otra ficha de técnico.'])
                ->withInput();
        }

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