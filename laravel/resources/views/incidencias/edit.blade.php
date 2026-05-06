@extends('layouts.app')

@section('title', 'Editar Incidencia')

@section('content')

<div class="page-header">
    <h1>Editar Incidencia</h1>
</div>

<form action="{{ route('incidencias.update', $incidencia->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Cliente</label>

        <select name="cliente_id" class="form-control">

            @foreach ($usuarios as $u)

                <option value="{{ $u->id }}"
                    {{ $incidencia->cliente_id == $u->id ? 'selected' : '' }}>

                    {{ $u->nombre }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Técnico</label>

        <select name="tecnico_id" class="form-control">

            @foreach ($tecnicos as $t)

                <option value="{{ $t->id }}"
                    {{ $incidencia->tecnico_id == $t->id ? 'selected' : '' }}>

                    {{ $t->nombre_completo }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Especialidad</label>

        <select name="especialidad_id" class="form-control">

            @foreach ($especialidades as $e)

                <option value="{{ $e->id }}"
                    {{ $incidencia->especialidad_id == $e->id ? 'selected' : '' }}>

                    {{ $e->nombre_especialidad }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Descripción</label>

        <textarea
            name="descripcion"
            class="form-control"
            rows="4"
            required>{{ $incidencia->descripcion }}</textarea>
    </div>

    <div class="form-group">
        <label>Dirección</label>

        <input type="text"
               name="direccion"
               class="form-control"
               value="{{ $incidencia->direccion }}"
               required>
    </div>

    <div class="form-group">
        <label>Teléfono contacto</label>

        <input type="text"
               name="telefono_contacto"
               class="form-control"
               value="{{ $incidencia->telefono_contacto }}"
               required>
    </div>

    <div class="form-group">
        <label>Fecha servicio</label>

        <input type="date"
               name="fecha_servicio"
               class="form-control"
               value="{{ \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('Y-m-d') }}"
               required>
    </div>

    <div class="form-group">
        <label>Tipo urgencia</label>

        <select name="tipo_urgencia" class="form-control">

            <option value="Estandar"
                {{ $incidencia->tipo_urgencia == 'Estandar' ? 'selected' : '' }}>
                Estándar
            </option>

            <option value="Urgente"
                {{ $incidencia->tipo_urgencia == 'Urgente' ? 'selected' : '' }}>
                Urgente
            </option>

        </select>
    </div>

    <div class="form-group">
        <label>Estado</label>

        <select name="estado" class="form-control">

            <option value="Pendiente"
                {{ $incidencia->estado == 'Pendiente' ? 'selected' : '' }}>
                Pendiente
            </option>

            <option value="Asignada"
                {{ $incidencia->estado == 'Asignada' ? 'selected' : '' }}>
                Asignada
            </option>

            <option value="Finalizada"
                {{ $incidencia->estado == 'Finalizada' ? 'selected' : '' }}>
                Finalizada
            </option>

            <option value="Cancelada"
                {{ $incidencia->estado == 'Cancelada' ? 'selected' : '' }}>
                Cancelada
            </option>

        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Actualizar incidencia
    </button>

    <a href="{{ route('incidencias.index') }}"
       class="btn btn-warning">
        Volver
    </a>

</form>

@endsection