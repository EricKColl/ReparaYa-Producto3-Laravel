@extends('layouts.app')

@section('title', 'Editar Técnico')

@section('content')

<div class="page-header">
    <h1>Editar Técnico</h1>
</div>

<form action="{{ route('tecnicos.update', $tecnico->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Usuario</label>

        <select name="usuario_id" class="form-control">

            @foreach ($usuarios as $u)

                <option value="{{ $u->id }}"
                    {{ $tecnico->usuario_id == $u->id ? 'selected' : '' }}>

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
               value="{{ $tecnico->nombre_completo }}"
               required>
    </div>

    <div class="form-group">
        <label>Especialidad</label>

        <select name="especialidad_id" class="form-control">

            @foreach ($especialidades as $e)

                <option value="{{ $e->id }}"
                    {{ $tecnico->especialidad_id == $e->id ? 'selected' : '' }}>

                    {{ $e->nombre_especialidad }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Disponible</label>

        <select name="disponible" class="form-control">

            <option value="1"
                {{ $tecnico->disponible ? 'selected' : '' }}>
                Sí
            </option>

            <option value="0"
                {{ !$tecnico->disponible ? 'selected' : '' }}>
                No
            </option>

        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Actualizar técnico
    </button>

    <a href="{{ route('tecnicos.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

@endsection