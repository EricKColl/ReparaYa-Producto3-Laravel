@extends('layouts.app')

@section('title', 'Incidencias')

@section('content')

<div class="page-header">
    <h1>Listado de Incidencias</h1>

    <a href="{{ route('incidencias.create') }}" class="btn btn-primary">
        Nueva incidencia
    </a>
</div>

@if ($incidencias->isEmpty())

    <p class="alert-empty">No hay incidencias registradas.</p>

@else

<table class="table">

    <thead>
        <tr>
            <th>Localizador</th>
            <th>Cliente</th>
            <th>Técnico</th>
            <th>Especialidad</th>
            <th>Estado</th>
            <th>Urgencia</th>
            <th>Fecha y hora</th>
            <th>Seguimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($incidencias as $i)

            @php
                $fechaServicio = \Carbon\Carbon::parse($i->fecha_servicio);

                $incidenciaAbierta = !in_array($i->estado, ['Finalizada', 'Cancelada']);
                $fechaVencida = $fechaServicio->isPast() && $incidenciaAbierta;
            @endphp

            <tr>

                <td>{{ $i->localizador }}</td>

                <td>{{ $i->cliente->nombre ?? 'Sin cliente' }}</td>

                <td>{{ $i->tecnico->nombre_completo ?? 'Sin técnico' }}</td>

                <td>{{ $i->especialidad->nombre_especialidad ?? 'Sin especialidad' }}</td>

                <td>{{ $i->estado }}</td>

                <td>
                    @if ($i->tipo_urgencia === 'Estandar')
                        Estándar
                    @else
                        {{ $i->tipo_urgencia }}
                    @endif
                </td>

                <td>{{ $fechaServicio->format('d/m/Y H:i') }}</td>

                <td>
                    @if ($fechaVencida && $i->estado === 'Asignada')
                        <span style="display:inline-block; padding:6px 10px; border-radius:8px; background:#fff3cd; color:#856404; font-weight:600;">
                            Pendiente de cierre
                        </span>
                    @elseif ($fechaVencida && $i->estado === 'Pendiente')
                        <span style="display:inline-block; padding:6px 10px; border-radius:8px; background:#f8d7da; color:#842029; font-weight:600;">
                            Fecha vencida
                        </span>
                    @elseif ($i->estado === 'Finalizada')
                        <span style="display:inline-block; padding:6px 10px; border-radius:8px; background:#d1e7dd; color:#0f5132; font-weight:600;">
                            Servicio cerrado
                        </span>
                    @elseif ($i->estado === 'Cancelada')
                        <span style="display:inline-block; padding:6px 10px; border-radius:8px; background:#e2e3e5; color:#41464b; font-weight:600;">
                            Cancelada
                        </span>
                    @else
                        <span style="display:inline-block; padding:6px 10px; border-radius:8px; background:#cff4fc; color:#055160; font-weight:600;">
                            En plazo
                        </span>
                    @endif
                </td>

                <td>

                    <div class="actions">

                        <a href="{{ route('incidencias.edit', $i->id) }}"
                           class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('incidencias.destroy', $i->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que quieres eliminar esta incidencia?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>

@endif

@endsection