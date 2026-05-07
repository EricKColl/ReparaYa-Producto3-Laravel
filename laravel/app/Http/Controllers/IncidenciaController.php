<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Usuario;
use App\Models\Tecnico;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with(['cliente', 'tecnico', 'especialidad'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        $clientes = Usuario::where('rol', 'particular')
            ->orderBy('nombre')
            ->get();

        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();

        $tecnicos = Tecnico::with(['usuario', 'especialidad'])
            ->where('disponible', 1)
            ->orderBy('nombre_completo')
            ->get();

        return view('incidencias.create', compact(
            'clientes',
            'especialidades',
            'tecnicos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:usuarios,id',
            'especialidad_id' => 'required|exists:especialidades,id',
            'tecnico_id' => 'nullable|exists:tecnicos,id',
            'descripcion' => 'required|string',
            'direccion' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'fecha_servicio' => 'required|date',
            'tipo_urgencia' => 'required|in:Estandar,Urgente'
        ]);

        $cliente = Usuario::findOrFail($request->cliente_id);

        if ($cliente->rol !== 'particular') {
            return back()
                ->withErrors(['cliente_id' => 'Solo los usuarios particulares pueden seleccionarse como clientes de una incidencia.'])
                ->withInput();
        }

        $estado = 'Pendiente';
        $tecnicoId = null;
        $especialidadId = $request->especialidad_id;

        if ($request->filled('tecnico_id')) {
            $tecnico = Tecnico::findOrFail($request->tecnico_id);

            if (!$tecnico->disponible) {
                return back()
                    ->withErrors(['tecnico_id' => 'Solo se pueden asignar incidencias a técnicos disponibles.'])
                    ->withInput();
            }

            if ((int) $tecnico->especialidad_id !== (int) $request->especialidad_id) {
                return back()
                    ->withErrors(['tecnico_id' => 'El técnico seleccionado no pertenece a la especialidad solicitada.'])
                    ->withInput();
            }

            $tecnicoId = $tecnico->id;
            $estado = 'Asignada';
        }

        Incidencia::create([
            'localizador' => 'INC-' . random_int(100000, 999999),
            'cliente_id' => $request->cliente_id,
            'tecnico_id' => $tecnicoId,
            'especialidad_id' => $especialidadId,
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'fecha_servicio' => $request->fecha_servicio,
            'tipo_urgencia' => $request->tipo_urgencia,
            'estado' => $estado,
            'created_at' => now()
        ]);

        return redirect()->route('incidencias.index');
    }

    public function edit($id)
    {
        $incidencia = Incidencia::findOrFail($id);

        $clientes = Usuario::where('rol', 'particular')
            ->orderBy('nombre')
            ->get();

        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();

        $tecnicos = Tecnico::with(['usuario', 'especialidad'])
            ->orderBy('nombre_completo')
            ->get();

        return view('incidencias.edit', compact(
            'incidencia',
            'clientes',
            'especialidades',
            'tecnicos'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:usuarios,id',
            'especialidad_id' => 'required|exists:especialidades,id',
            'tecnico_id' => 'nullable|exists:tecnicos,id',
            'descripcion' => 'required|string',
            'direccion' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'fecha_servicio' => 'required|date',
            'tipo_urgencia' => 'required|in:Estandar,Urgente',
            'estado' => 'required|in:Pendiente,Asignada,Finalizada,Cancelada'
        ]);

        $cliente = Usuario::findOrFail($request->cliente_id);

        if ($cliente->rol !== 'particular') {
            return back()
                ->withErrors(['cliente_id' => 'Solo los usuarios particulares pueden seleccionarse como clientes de una incidencia.'])
                ->withInput();
        }

        if (
            $request->estado === 'Finalizada' &&
            Carbon::parse($request->fecha_servicio)->isFuture()
        ) {
            return back()
                ->withErrors(['estado' => 'No se puede marcar una incidencia como Finalizada antes de la fecha y hora del servicio.'])
                ->withInput();
        }

        $tecnicoId = null;

        if ($request->filled('tecnico_id')) {
            $tecnico = Tecnico::findOrFail($request->tecnico_id);

            if ((int) $tecnico->especialidad_id !== (int) $request->especialidad_id) {
                return back()
                    ->withErrors(['tecnico_id' => 'El técnico seleccionado no pertenece a la especialidad solicitada.'])
                    ->withInput();
            }

            $tecnicoId = $tecnico->id;

            if ($request->estado === 'Pendiente') {
                return back()
                    ->withErrors(['estado' => 'Una incidencia con técnico asignado no puede quedar en estado Pendiente.'])
                    ->withInput();
            }
        }

        if (!$request->filled('tecnico_id') && in_array($request->estado, ['Asignada', 'Finalizada'])) {
            return back()
                ->withErrors(['estado' => 'Una incidencia sin técnico no puede estar Asignada ni Finalizada.'])
                ->withInput();
        }

        $incidencia = Incidencia::findOrFail($id);

        $incidencia->update([
            'cliente_id' => $request->cliente_id,
            'tecnico_id' => $tecnicoId,
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