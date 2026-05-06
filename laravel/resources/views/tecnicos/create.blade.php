@extends('layouts.app')

@section('title', 'Nuevo Técnico')

@section('content')

<div class="page-header">
    <h1>Nuevo Técnico</h1>
</div>

<form action="{{ route('tecnicos.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Usuario</label>

        <select name="usuario_id" class="form-control">

            @foreach ($usuarios as $u)

                <option value="{{ $u->id }}">
                    {{ $u->nombre }} - {{ $u->email }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Nombre completo</label>

        <input type="text"
               name="nombre_completo"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Especialidad</label>

        <select name="especialidad_id" class="form-control">

            @foreach ($especialidades as $e)

                <option value="{{ $e->id }}">
                    {{ $e->nombre_especialidad }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Disponible</label>

        <select name="disponible" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Crear técnico
    </button>

    <a href="{{ route('tecnicos.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

@endsection