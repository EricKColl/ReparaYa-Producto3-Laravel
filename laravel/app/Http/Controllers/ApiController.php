<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\JsonResponse;

/**
 * ApiController
 * Proporciona el endpoint REST /api/servicios/zonas
 */
class ApiController extends Controller
{
    /**
     * GET /api/servicios/zonas
     *
     * Devuelve un JSON con los servicios agrupados por zona.
     * Cada entrada tiene:
     *   - zona: nombre de la zona
     *   - total_servicios: cuántos servicios hay en esa zona
     *   - porcentaje: qué % representa sobre el total global
     *
     * Solo cuenta incidencias que tengan comunidad asignada (B2B).
     * Si quieres incluir todas, quita el whereNotNull.
     */
    public function serviciosPorZona(): JsonResponse
    {
        // Total global de servicios (para calcular el porcentaje)
        $totalGlobal = Incidencia::whereNotNull('comunidad_id')->count();

        if ($totalGlobal === 0) {
            return response()->json([
                'total_global' => 0,
                'zonas'        => [],
            ]);
        }

        // Agrupamos por zona usando JOIN con la tabla comunidades
        $porZona = Incidencia::selectRaw('comunidades.zona, COUNT(*) as total_servicios')
            ->join('comunidades', 'incidencias.comunidad_id', '=', 'comunidades.id')
            ->groupBy('comunidades.zona')
            ->orderByDesc('total_servicios')
            ->get();

        // Construimos el array de respuesta con el porcentaje calculado
        $zonas = $porZona->map(function ($fila) use ($totalGlobal) {
            return [
                'zona'             => $fila->zona,
                'total_servicios'  => $fila->total_servicios,
                'porcentaje'       => round(($fila->total_servicios / $totalGlobal) * 100, 2),
            ];
        });

        return response()->json([
            'total_global' => $totalGlobal,
            'zonas'        => $zonas,
        ]);
    }
}
