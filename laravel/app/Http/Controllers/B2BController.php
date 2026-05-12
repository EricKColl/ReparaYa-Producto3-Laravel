<?php

namespace App\Http\Controllers;

use App\Models\Gestora;
use App\Models\Comunidad;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class B2BController extends Controller
{

    public function showLogin()
    {
        return view('b2b.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $gestora = Gestora::where('email', $request->email)->first();

        if (!$gestora || !Hash::check($request->password, $gestora->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas.']);
        }

        session(['gestora_id'     => $gestora->id]);
        session(['gestora_nombre' => $gestora->nombre]);

        return redirect()->route('b2b.panel');
    }

    public function logout()
    {
        session()->forget(['gestora_id', 'gestora_nombre']);
        return redirect()->route('b2b.login');
    }

    public function panel(Request $request)
    {
        if (!session('gestora_id')) {
            return redirect()->route('b2b.login');
        }

        $gestora = Gestora::findOrFail(session('gestora_id'));

        $mes  = $request->get('mes',  now()->month);
        $anyo = $request->get('anyo', now()->year);

        $servicios = Incidencia::with(['comunidad', 'especialidad'])
            ->where('gestora_id', $gestora->id)
            ->whereMonth('fecha_servicio', $mes)
            ->whereYear('fecha_servicio', $anyo)
            ->orderBy('fecha_servicio', 'desc')
            ->get();

        $serviciosConComision = $servicios->map(function ($inc) use ($gestora) {
            $inc->comision_calculada = round($inc->precio_base * ($gestora->comision / 100), 2);
            return $inc;
        });

        $totalComisiones = $serviciosConComision->sum('comision_calculada');

        $anyos = range(2024, now()->year);

        return view('b2b.panel', compact(
            'gestora',
            'serviciosConComision',
            'totalComisiones',
            'mes',
            'anyo',
            'anyos'
        ));
    }

    public function createAviso()
    {
        if (!session('gestora_id')) {
            return redirect()->route('b2b.login');
        }

        $gestora      = Gestora::findOrFail(session('gestora_id'));
        $comunidades  = $gestora->comunidades;
        $especialidades = \App\Models\Especialidad::all();

        return view('b2b.create_aviso', compact('gestora', 'comunidades', 'especialidades'));
    }

    public function storeAviso(Request $request)
    {
        if (!session('gestora_id')) {
            return redirect()->route('b2b.login');
        }

        $gestora = Gestora::findOrFail(session('gestora_id'));

        $request->validate([
            'comunidad_id' => 'required|exists:comunidades,id',
            'descripcion'  => 'required|string',
            'telefono_contacto' => 'required|string|max:20',
            'fecha_servicio'    => 'required|date',
            'tipo_urgencia'     => 'required|in:Estandar,Urgente',
            'precio_base'       => 'required|numeric|min:0',
            'especialidad_id'   => 'required|exists:especialidades,id',
        ]);

        $comunidad = Comunidad::where('id', $request->comunidad_id)
            ->where('gestora_id', $gestora->id)
            ->firstOrFail();

        Incidencia::create([
            'localizador'       => 'B2B-' . random_int(100000, 999999),
            'cliente_id'        => 1,
            'descripcion'       => $request->descripcion,
            'direccion'         => $comunidad->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'fecha_servicio'    => $request->fecha_servicio,
            'tipo_urgencia'     => $request->tipo_urgencia,
            'estado'            => 'Pendiente',
            'gestora_id'        => $gestora->id,
            'comunidad_id'      => $comunidad->id,
            'precio_base'       => $request->precio_base,
            'created_at'        => now(),
            'especialidad_id'   => $request->especialidad_id
        ]);

        return redirect()->route('b2b.panel')->with('success', 'Aviso creado correctamente.');
    }

    public function liquidaciones(Request $request)
    {
        if (session('usuario_rol') !== 'admin') {
            return redirect('/')->with('error', 'Acceso denegado.');
        }

        $mes  = $request->get('mes',  now()->month);
        $anyo = $request->get('anyo', now()->year);

        $gestoras = Gestora::with(['incidencias' => function ($query) use ($mes, $anyo) {
            $query->where('estado', 'Finalizada')
                ->whereMonth('fecha_servicio', $mes)
                ->whereYear('fecha_servicio', $anyo);
        }])->get();

        $liquidaciones = $gestoras->map(function ($gestora) {
            $totalServicios = $gestora->incidencias->count();
            $totalImporte   = $gestora->incidencias->sum('precio_base');
            $totalComision  = round($totalImporte * ($gestora->comision / 100), 2);

            return [
                'gestora'         => $gestora,
                'total_servicios' => $totalServicios,
                'total_importe'   => $totalImporte,
                'total_comision'  => $totalComision,
            ];
        });

        $anyos = range(2024, now()->year);

        return view('liquidaciones.index', compact('liquidaciones', 'mes', 'anyo', 'anyos'));
    }
}
