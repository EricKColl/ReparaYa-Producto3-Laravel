<h1>Listado de Especialidades</h1>

<a href="{{ route('especialidades.create') }}">Nueva especialidad</a>

<br><br>

@if ($especialidades->isEmpty())
    <p>No hay especialidades registradas.</p>
@else
    @foreach ($especialidades as $e)
    <p>
        {{ $e->nombre_especialidad }}

        <a href="{{ route('especialidades.edit', $e->id) }}">Editar</a>

        <form action="{{ route('especialidades.destroy', $e->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </p>
@endforeach
@endif