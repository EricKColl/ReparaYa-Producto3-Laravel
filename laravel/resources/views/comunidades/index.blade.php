@extends('layouts.app')

@section('title', 'Comunidades')

@section('content')

<div class="page-header">
    <h1>Comunidades</h1>
    <a href="{{ route('comunidades.create') }}" class="btn btn-primary">+ Nueva Comunidad</a>
</div>

@if(session('success'))
    <div class="flash-message flash-success">{{ session('success') }}</div>
@endif

@if($comunidades->isEmpty())
    <p class="alert-empty">No hay comunidades registradas todavía.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Zona</th>
                <th>Gestora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comunidades as $comunidad)
            <tr>
                <td>{{ $comunidad->nombre }}</td>
                <td>{{ $comunidad->direccion }}</td>
                <td><span class="tag">{{ $comunidad->zona }}</span></td>
                <td>{{ $comunidad->gestora->nombre ?? '-' }}</td>
                <td class="actions">
                    <a href="{{ route('comunidades.edit', $comunidad->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('comunidades.destroy', $comunidad->id) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta comunidad?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
