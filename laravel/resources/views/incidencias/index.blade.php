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
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($incidencias as $i)

            <tr>

                <td>{{ $i->localizador }}</td>

                <td>{{ $i->cliente->nombre ?? 'Sin cliente' }}</td>

                <td>{{ $i->tecnico->nombre_completo ?? 'Sin técnico' }}</td>

                <td>{{ $i->especialidad->nombre_especialidad ?? 'Sin especialidad' }}</td>

                <td>{{ $i->estado }}</td>

                <td>{{ $i->tipo_urgencia }}</td>

                <td>{{ $i->fecha_servicio }}</td>

                <td>

                    <div class="actions">

                        <a href="{{ route('incidencias.edit', $i->id) }}"
                           class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('incidencias.destroy', $i->id) }}"
                              method="POST">

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