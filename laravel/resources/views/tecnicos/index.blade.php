<h1>Listado de Técnicos</h1>

<a href="{{ route('tecnicos.create') }}">Nuevo técnico</a>

<br><br>

@if ($tecnicos->isEmpty())
    <p>No hay técnicos registrados.</p>
@else
    @foreach ($tecnicos as $t)
        <p>
            <strong>{{ $t->nombre_completo }}</strong>

            - Usuario asociado: {{ $t->usuario->nombre ?? 'Sin usuario' }}

            - Especialidad: {{ $t->especialidad->nombre_especialidad ?? 'Sin especialidad' }}

            - Disponible: {{ $t->disponible ? 'Sí' : 'No' }}

            <a href="{{ route('tecnicos.edit', $t->id) }}">Editar</a>

            <form action="{{ route('tecnicos.destroy', $t->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </p>
    @endforeach
@endif