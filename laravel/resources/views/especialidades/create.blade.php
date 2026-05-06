@extends('layouts.app')

@section('title', 'Nueva Especialidad')

@section('content')

    <div class="page-header">
        <h1>Nueva Especialidad</h1>
    </div>

    <form action="{{ route('especialidades.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Nombre de la especialidad</label>

            <input
                type="text"
                name="nombre_especialidad"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar especialidad
        </button>

        <a href="{{ route('especialidades.index') }}" class="btn btn-warning">
            Volver
        </a>

    </form>

@endsection