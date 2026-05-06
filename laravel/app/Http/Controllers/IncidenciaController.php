<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Usuario;
use App\Models\Tecnico;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with(['cliente', 'tecnico', 'especialidad'])->get();

        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $tecnicos = Tecnico::all();
        $especialidades = Especialidad::all();

        return view('incidencias.create', compact(
            'usuarios',
            'tecnicos',
            'especialidades'
        ));
    }

    public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:usuarios,id',
        'tecnico_id' => 'required|exists:tecnicos,id',
        'especialidad_id' => 'required|exists:especialidades,id',
        'descripcion' => 'required|string',
        'direccion' => 'required|string|max:255',
        'telefono_contacto' => 'required|string|max:20',
        'fecha_servicio' => 'required|date',
        'tipo_urgencia' => 'required|in:Estandar,Urgente',
        'estado' => 'required|in:Pendiente,Asignada,Finalizada,Cancelada'
    ]);

    Incidencia::create([
        'localizador' => 'INC-' . random_int(100000, 999999),
        'cliente_id' => $request->cliente_id,
        'tecnico_id' => $request->tecnico_id,
        'especialidad_id' => $request->especialidad_id,
        'descripcion' => $request->descripcion,
        'direccion' => $request->direccion,
        'telefono_contacto' => $request->telefono_contacto,
        'fecha_servicio' => $request->fecha_servicio,
        'tipo_urgencia' => $request->tipo_urgencia,
        'estado' => $request->estado,
        'created_at' => now()
    ]);

    return redirect()->route('incidencias.index');
}
    public function edit($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $clientes = Usuario::where('rol', 'particular')->get();
        $tecnicos = Tecnico::all();
        $especialidades = Especialidad::all();

        return view('incidencias.edit', compact('incidencia', 'clientes', 'tecnicos', 'especialidades'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'cliente_id' => 'required|exists:usuarios,id',
        'tecnico_id' => 'required|exists:tecnicos,id',
        'especialidad_id' => 'required|exists:especialidades,id',
        'descripcion' => 'required|string',
        'direccion' => 'required|string|max:255',
        'telefono_contacto' => 'required|string|max:20',
        'fecha_servicio' => 'required|date',
        'tipo_urgencia' => 'required|in:Estandar,Urgente',
        'estado' => 'required|in:Pendiente,Asignada,Finalizada,Cancelada'
    ]);

    $incidencia = Incidencia::findOrFail($id);

    $incidencia->update([
        'cliente_id' => $request->cliente_id,
        'tecnico_id' => $request->tecnico_id,
        'especialidad_id' => $request->especialidad_id,
        'descripcion' => $request->descripcion,
        'direccion' => $request->direccion,
        'telefono_contacto' => $request->telefono_contacto,
        'fecha_servicio' => $request->fecha_servicio,
        'tipo_urgencia' => $request->tipo_urgencia,
        'estado' => $request->estado
    ]);

    return redirect()->route('incidencias.index');
}

    public function destroy($id)
    {
        $incidencia = Incidencia::findOrFail($id);

        $incidencia->delete();

        return redirect()->route('incidencias.index');
    }
}