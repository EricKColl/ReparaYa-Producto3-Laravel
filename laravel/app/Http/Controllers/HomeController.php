<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Tecnico;
use App\Models\Especialidad;
use App\Models\Incidencia;

class HomeController extends Controller
{
    public function index()
    {
        $usuario = null;
        $tipoInicio = 'visitante';

        if (session()->has('usuario_id')) {
            $usuario = [
                'id' => session('usuario_id'),
                'nombre' => session('usuario_nombre'),
                'rol' => session('usuario_rol')
            ];

            $tipoInicio = session('usuario_rol');
        }

        $dashboard = $this->obtenerDashboardGeneral();
        $panelUsuario = $this->obtenerPanelUsuario($usuario, $tipoInicio);

        return view('home', compact(
            'usuario',
            'dashboard',
            'panelUsuario',
            'tipoInicio'
        ));
    }

    private function obtenerDashboardGeneral(): array
    {
        $totalUsuarios = Usuario::count();
        $totalParticulares = Usuario::where('rol', 'particular')->count();
        $totalUsuariosTecnicos = Usuario::where('rol', 'tecnico')->count();
        $totalAdmins = Usuario::where('rol', 'admin')->count();

        $totalTecnicos = Tecnico::count();
        $tecnicosDisponibles = Tecnico::where('disponible', 1)->count();
        $tecnicosNoDisponibles = Tecnico::where('disponible', 0)->count();

        $totalEspecialidades = Especialidad::count();

        $totalIncidencias = Incidencia::count();
        $incidenciasPendientes = Incidencia::where('estado', 'Pendiente')->count();
        $incidenciasAsignadas = Incidencia::where('estado', 'Asignada')->count();
        $incidenciasFinalizadas = Incidencia::where('estado', 'Finalizada')->count();
        $incidenciasCanceladas = Incidencia::where('estado', 'Cancelada')->count();

        $incidenciasUrgentes = Incidencia::where('tipo_urgencia', 'Urgente')->count();
        $incidenciasEstandar = Incidencia::where('tipo_urgencia', 'Estandar')->count();

        $incidenciasAbiertas = $incidenciasPendientes + $incidenciasAsignadas;

        return [
            'totales' => [
                'usuarios' => $totalUsuarios,
                'particulares' => $totalParticulares,
                'usuarios_tecnicos' => $totalUsuariosTecnicos,
                'admins' => $totalAdmins,

                'tecnicos' => $totalTecnicos,
                'tecnicos_disponibles' => $tecnicosDisponibles,
                'tecnicos_no_disponibles' => $tecnicosNoDisponibles,

                'especialidades' => $totalEspecialidades,

                'incidencias' => $totalIncidencias,
                'incidencias_abiertas' => $incidenciasAbiertas,
                'pendientes' => $incidenciasPendientes,
                'asignadas' => $incidenciasAsignadas,
                'finalizadas' => $incidenciasFinalizadas,
                'canceladas' => $incidenciasCanceladas,
                'urgentes' => $incidenciasUrgentes,
                'estandar' => $incidenciasEstandar,
            ],

            'porcentajes' => [
                'tecnicos_disponibles' => $this->porcentaje($tecnicosDisponibles, $totalTecnicos),
                'tecnicos_no_disponibles' => $this->porcentaje($tecnicosNoDisponibles, $totalTecnicos),

                'pendientes' => $this->porcentaje($incidenciasPendientes, $totalIncidencias),
                'asignadas' => $this->porcentaje($incidenciasAsignadas, $totalIncidencias),
                'finalizadas' => $this->porcentaje($incidenciasFinalizadas, $totalIncidencias),
                'canceladas' => $this->porcentaje($incidenciasCanceladas, $totalIncidencias),

                'urgentes' => $this->porcentaje($incidenciasUrgentes, $totalIncidencias),
                'estandar' => $this->porcentaje($incidenciasEstandar, $totalIncidencias),

                'resolucion' => $this->porcentaje($incidenciasFinalizadas, $totalIncidencias),
                'actividad_abierta' => $this->porcentaje($incidenciasAbiertas, $totalIncidencias),
            ]
        ];
    }

    private function obtenerPanelUsuario(?array $usuario, string $tipoInicio): array
    {
        if ($usuario === null) {
            return [
                'tipo' => 'visitante',
                'titulo' => 'Bienvenido a ReparaYa',
                'subtitulo' => 'Una plataforma diseñada para gestionar reparaciones con orden, rapidez y una imagen profesional.',
                'accion_principal' => 'Ir al login',
                'url_principal' => url('/login'),
                'metricas' => []
            ];
        }

        if ($tipoInicio === 'admin') {
            return [
                'tipo' => 'admin',
                'titulo' => 'Panel de administración',
                'subtitulo' => 'Vista global de usuarios, técnicos, incidencias, disponibilidad y actividad operativa.',
                'accion_principal' => 'Gestionar incidencias',
                'url_principal' => url('/incidencias'),
                'metricas' => [
                    'usuarios' => Usuario::count(),
                    'tecnicos' => Tecnico::count(),
                    'incidencias' => Incidencia::count(),
                    'pendientes' => Incidencia::where('estado', 'Pendiente')->count(),
                ]
            ];
        }

        if ($tipoInicio === 'tecnico') {
            $tecnico = Tecnico::where('usuario_id', $usuario['id'])->first();

            if (!$tecnico) {
                return [
                    'tipo' => 'tecnico',
                    'titulo' => 'Área técnica',
                    'subtitulo' => 'Tu usuario todavía no está vinculado a una ficha técnica. Cuando se vincule, podrás consultar tus servicios asignados.',
                    'accion_principal' => 'Ver técnicos',
                    'url_principal' => url('/tecnicos'),
                    'metricas' => [
                        'asignadas' => 0,
                        'pendientes' => 0,
                        'finalizadas' => 0,
                    ]
                ];
            }

            $totalAsignadas = Incidencia::where('tecnico_id', $tecnico->id)->count();
            $pendientes = Incidencia::where('tecnico_id', $tecnico->id)
                ->whereIn('estado', ['Pendiente', 'Asignada'])
                ->count();
            $finalizadas = Incidencia::where('tecnico_id', $tecnico->id)
                ->where('estado', 'Finalizada')
                ->count();

            return [
                'tipo' => 'tecnico',
                'titulo' => 'Área técnica',
                'subtitulo' => 'Consulta tus intervenciones asignadas, revisa el estado del servicio y mantén cada actuación bajo control.',
                'accion_principal' => 'Ver incidencias',
                'url_principal' => url('/incidencias'),
                'metricas' => [
                    'asignadas' => $totalAsignadas,
                    'pendientes' => $pendientes,
                    'finalizadas' => $finalizadas,
                ]
            ];
        }

        if ($tipoInicio === 'particular') {
            $totalIncidencias = Incidencia::where('cliente_id', $usuario['id'])->count();
            $abiertas = Incidencia::where('cliente_id', $usuario['id'])
                ->whereIn('estado', ['Pendiente', 'Asignada'])
                ->count();
            $finalizadas = Incidencia::where('cliente_id', $usuario['id'])
                ->where('estado', 'Finalizada')
                ->count();

            return [
                'tipo' => 'particular',
                'titulo' => 'Mis reparaciones',
                'subtitulo' => 'Consulta tus avisos, revisa el estado de cada servicio y crea nuevas solicitudes cuando lo necesites.',
                'accion_principal' => 'Crear incidencia',
                'url_principal' => url('/incidencias/create'),
                'metricas' => [
                    'total' => $totalIncidencias,
                    'abiertas' => $abiertas,
                    'finalizadas' => $finalizadas,
                ]
            ];
        }

        return [
            'tipo' => 'desconocido',
            'titulo' => 'ReparaYa',
            'subtitulo' => 'Entorno de gestión de reparaciones.',
            'accion_principal' => 'Ir al inicio',
            'url_principal' => url('/'),
            'metricas' => []
        ];
    }

    private function porcentaje(int $valor, int $total): int
    {
        if ($total <= 0) {
            return 0;
        }

        return (int) round(($valor / $total) * 100);
    }
}