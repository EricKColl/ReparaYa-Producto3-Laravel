@extends('layouts.app')

@section('title', 'Especialidades')

@section('content')
    <div class="page-header">
        <h1>Listado de Especialidades</h1>
        <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Nueva especialidad</a>
    </div>

    @if ($especialidades->isEmpty())
        <p class="alert-empty">No hay especialidades registradas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($especialidades as $e)
                    <tr>
                        <td>{{ $e->id }}</td>
                        <td>{{ $e->nombre_especialidad }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('especialidades.edit', $e->id) }}" class="btn btn-warning">Editar</a>

                                <form action="{{ route('especialidades.destroy', $e->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection