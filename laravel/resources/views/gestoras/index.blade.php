@extends('layouts.app')

@section('title', 'Gestoras B2B')

@section('content')

<div class="page-header">
    <h1>Gestoras B2B</h1>
    <a href="{{ route('gestoras.create') }}" class="btn btn-primary">+ Nueva Gestora</a>
</div>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div style="background:#d1e7dd; padding:10px; border-radius:6px; margin-bottom:15px; color:#0f5132;">
        {{ session('success') }}
    </div>
@endif

@if($gestoras->isEmpty())
    <p class="alert-empty">No hay gestoras registradas todavía.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Comisión (%)</th>
                <th>Nº Servicios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gestoras as $gestora)
            <tr>
                <td>{{ $gestora->nombre }}</td>
                <td>{{ $gestora->email }}</td>
                <td>{{ $gestora->telefono ?? '-' }}</td>
                <td>{{ $gestora->comision }}%</td>
                <td>{{ $gestora->incidencias_count }}</td>
                <td class="actions">
                    <a href="{{ route('gestoras.edit', $gestora->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('gestoras.destroy', $gestora->id) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta gestora?')">
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
