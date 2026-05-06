@extends('layouts.app')

@section('title', 'Técnicos')

@section('content')

<div class="page-header">
    <h1>Listado de Técnicos</h1>

    <a href="{{ route('tecnicos.create') }}" class="btn btn-primary">
        Nuevo técnico
    </a>
</div>

@if ($tecnicos->isEmpty())

    <p class="alert-empty">No hay técnicos registrados.</p>

@else

<table class="table">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario asociado</th>
            <th>Especialidad</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($tecnicos as $t)

            <tr>

                <td>{{ $t->id }}</td>

                <td>{{ $t->nombre_completo }}</td>

                <td>
                    {{ $t->usuario->nombre ?? 'Sin usuario' }}
                </td>

                <td>
                    {{ $t->especialidad->nombre_especialidad ?? 'Sin especialidad' }}
                </td>

                <td>
                    {{ $t->disponible ? 'Sí' : 'No' }}
                </td>

                <td>

                    <div class="actions">

                        <a href="{{ route('tecnicos.edit', $t->id) }}"
                           class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('tecnicos.destroy', $t->id) }}"
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