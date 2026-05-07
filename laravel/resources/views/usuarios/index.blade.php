@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<div class="page-header">
    <h1>Listado de Usuarios</h1>

    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        Nuevo usuario
    </a>
</div>

@if ($usuarios->isEmpty())

    <p class="alert-empty">No hay usuarios registrados.</p>

@else

<table class="table">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($usuarios as $u)

            <tr>

                <td>{{ $u->id }}</td>

                <td>{{ $u->nombre }}</td>

                <td>{{ $u->email }}</td>

                <td>
                    @if ($u->rol === 'tecnico')
                        Técnico
                    @elseif ($u->rol === 'admin')
                        Admin
                    @else
                        Particular
                    @endif
                </td>

                <td>{{ $u->telefono }}</td>

                <td>

                    <div class="actions">

                        <a href="{{ route('usuarios.edit', $u->id) }}"
                           class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('usuarios.destroy', $u->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">

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