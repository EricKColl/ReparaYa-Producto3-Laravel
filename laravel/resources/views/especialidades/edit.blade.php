@extends('layouts.app')

@section('title', 'Editar Especialidad')

@section('content')

    <div class="page-header">
        <h1>Editar Especialidad</h1>
    </div>

    <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre de la especialidad</label>

            <input
                type="text"
                name="nombre_especialidad"
                class="form-control"
                value="{{ $especialidad->nombre_especialidad }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar especialidad
        </button>

        <a href="{{ route('especialidades.index') }}" class="btn btn-warning">
            Volver
        </a>

    </form>

@endsection