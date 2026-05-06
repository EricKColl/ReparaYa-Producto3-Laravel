<h1>Listado de Incidencias</h1>

<a href="{{ route('incidencias.create') }}">Nueva incidencia</a>

<br><br>

@if ($incidencias->isEmpty())
    <p>No hay incidencias registradas.</p>
@else
    @foreach ($incidencias as $i)
        <p>
            <strong>{{ $i->localizador }}</strong>
            - Cliente: {{ $i->cliente->nombre ?? 'Sin cliente' }}
            - Técnico: {{ $i->tecnico->nombre_completo ?? 'Sin técnico' }}
            - Especialidad: {{ $i->especialidad->nombre_especialidad ?? 'Sin especialidad' }}
            - Estado: {{ ucfirst($i->estado) }}
            - Urgencia: {{ ucfirst($i->tipo_urgencia) }}
            - Fecha: {{ $i->fecha_servicio }}

            <a href="{{ route('incidencias.edit', $i->id) }}">Editar</a>

            <form action="{{ route('incidencias.destroy', $i->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </p>
    @endforeach
@endif