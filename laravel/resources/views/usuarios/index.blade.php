<h1>Listado de Usuarios</h1>

<a href="{{ route('usuarios.create') }}">Nuevo usuario</a>

<br><br>

@if ($usuarios->isEmpty())
    <p>No hay usuarios registrados.</p>
@else
    @foreach ($usuarios as $u)
        <p>
            <strong>{{ $u->nombre }}</strong>
            - {{ $u->email }}
            - Rol: {{ $u->rol }}
            - Tel: {{ $u->telefono }}

            <a href="{{ route('usuarios.edit', $u->id) }}">Editar</a>

            <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </p>
    @endforeach
@endif