@extends('layouts.app')

@section('title', 'Nueva Incidencia')

@section('content')

<div class="page-header">
    <h1>Nueva Incidencia</h1>
</div>

<form action="{{ route('incidencias.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Cliente</label>

        <select name="cliente_id" class="form-control">

            @foreach ($usuarios as $u)

                <option value="{{ $u->id }}">
                    {{ $u->nombre }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Técnico</label>

        <select name="tecnico_id" class="form-control">

            @foreach ($tecnicos as $t)

                <option value="{{ $t->id }}">
                    {{ $t->nombre_completo }}
                </option>

            @endforeach

        </select>
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
        <label>Descripción</label>

        <textarea
            name="descripcion"
            class="form-control"
            rows="4"
            required></textarea>
    </div>

    <div class="form-group">
        <label>Dirección</label>

        <input type="text"
               name="direccion"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Teléfono contacto</label>

        <input type="text"
               name="telefono_contacto"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Fecha servicio</label>

        <input type="date"
               name="fecha_servicio"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Tipo urgencia</label>

        <select name="tipo_urgencia" class="form-control">

            <option value="Estandar">Estándar</option>
            <option value="Urgente">Urgente</option>

        </select>
    </div>

    <div class="form-group">
        <label>Estado</label>

        <select name="estado" class="form-control">

            <option value="Pendiente">Pendiente</option>
            <option value="Asignada">Asignada</option>
            <option value="Finalizada">Finalizada</option>
            <option value="Cancelada">Cancelada</option>

        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Crear incidencia
    </button>

    <a href="{{ route('incidencias.index') }}"
       class="btn btn-warning">
        Volver
    </a>

</form>

@endsection