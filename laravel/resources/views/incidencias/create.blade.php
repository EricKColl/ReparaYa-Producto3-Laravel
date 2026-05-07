@extends('layouts.app')

@section('title', 'Nueva Incidencia')

@section('content')

<div class="page-header">
    <h1>Nueva Incidencia</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        <strong>No se ha podido crear la incidencia.</strong>
        <ul style="margin-top: 10px; margin-bottom: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('incidencias.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Cliente</label>

        <select name="cliente_id" id="cliente_id" class="form-control" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                        data-telefono="{{ $cliente->telefono ?? '' }}"
                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }} - {{ $cliente->email }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Especialidad solicitada</label>

        <select name="especialidad_id" id="especialidad_id" class="form-control" required>
            @foreach ($especialidades as $especialidad)
                <option value="{{ $especialidad->id }}"
                        {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                    {{ $especialidad->nombre_especialidad }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Técnico asignado</label>

        <select name="tecnico_id" id="tecnico_id" class="form-control">
            <option value="">
                Sin asignar por ahora
            </option>

            @foreach ($tecnicos as $tecnico)
                <option value="{{ $tecnico->id }}"
                        data-especialidad-id="{{ $tecnico->especialidad_id }}"
                        data-especialidad="{{ $tecnico->especialidad->nombre_especialidad ?? 'Sin especialidad' }}"
                        {{ old('tecnico_id') == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->nombre_completo }}
                    @if ($tecnico->especialidad)
                        - {{ $tecnico->especialidad->nombre_especialidad }}
                    @endif
                </option>
            @endforeach
        </select>

        <small style="display:block; margin-top:6px; color:#666;">
            Solo se mostrarán como válidos los técnicos que coincidan con la especialidad solicitada.
        </small>
    </div>

    <div class="form-group">
        <label>Estado inicial</label>

        <input type="text"
               id="estado_visible"
               class="form-control"
               value="Pendiente"
               readonly>

        <small style="display:block; margin-top:6px; color:#666;">
            Si no se asigna técnico, la incidencia queda Pendiente. Si se asigna técnico, queda Asignada automáticamente.
        </small>
    </div>

    <div class="form-group">
        <label>Descripción</label>

        <textarea
            name="descripcion"
            class="form-control"
            rows="4"
            required>{{ old('descripcion') }}</textarea>
    </div>

    <div class="form-group">
        <label>Dirección</label>

        <input type="text"
               name="direccion"
               class="form-control"
               value="{{ old('direccion') }}"
               required>
    </div>

    <div class="form-group">
        <label>Teléfono contacto</label>

        <input type="text"
               name="telefono_contacto"
               id="telefono_contacto"
               class="form-control"
               value="{{ old('telefono_contacto') }}"
               required>
    </div>

    <div class="form-group">
        <label>Fecha y hora del servicio</label>

        <input type="datetime-local"
               name="fecha_servicio"
               class="form-control"
               value="{{ old('fecha_servicio', now()->format('Y-m-d\TH:i')) }}"
               required>
    </div>

    <div class="form-group">
        <label>Tipo urgencia</label>

        <select name="tipo_urgencia" class="form-control" required>
            <option value="Estandar" {{ old('tipo_urgencia') == 'Estandar' ? 'selected' : '' }}>
                Estándar
            </option>

            <option value="Urgente" {{ old('tipo_urgencia') == 'Urgente' ? 'selected' : '' }}>
                Urgente
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Crear incidencia
    </button>

    <a href="{{ route('incidencias.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

<script>
    function actualizarTelefonoCliente(forzarCambio = false) {
        const selectCliente = document.getElementById('cliente_id');
        const telefonoContacto = document.getElementById('telefono_contacto');

        if (!selectCliente || !telefonoContacto) {
            return;
        }

        const opcionSeleccionada = selectCliente.options[selectCliente.selectedIndex];
        const telefonoCliente = opcionSeleccionada.dataset.telefono || '';

        if (forzarCambio || telefonoContacto.value.trim() === '') {
            telefonoContacto.value = telefonoCliente;
        }
    }

    function filtrarTecnicosPorEspecialidad() {
        const selectEspecialidad = document.getElementById('especialidad_id');
        const selectTecnico = document.getElementById('tecnico_id');

        if (!selectEspecialidad || !selectTecnico) {
            return;
        }

        const especialidadSeleccionada = selectEspecialidad.value;
        const tecnicoSeleccionado = selectTecnico.options[selectTecnico.selectedIndex];

        for (let i = 0; i < selectTecnico.options.length; i++) {
            const opcion = selectTecnico.options[i];

            if (opcion.value === '') {
                opcion.hidden = false;
                opcion.disabled = false;
                continue;
            }

            const coincide = opcion.dataset.especialidadId === especialidadSeleccionada;

            opcion.hidden = !coincide;
            opcion.disabled = !coincide;
        }

        if (
            tecnicoSeleccionado &&
            tecnicoSeleccionado.value !== '' &&
            tecnicoSeleccionado.dataset.especialidadId !== especialidadSeleccionada
        ) {
            selectTecnico.value = '';
        }

        actualizarEstadoInicial();
    }

    function actualizarEstadoInicial() {
        const selectTecnico = document.getElementById('tecnico_id');
        const estadoVisible = document.getElementById('estado_visible');

        if (!selectTecnico || !estadoVisible) {
            return;
        }

        estadoVisible.value = selectTecnico.value ? 'Asignada' : 'Pendiente';
    }

    document.addEventListener('DOMContentLoaded', function () {
        actualizarTelefonoCliente(false);
        filtrarTecnicosPorEspecialidad();
        actualizarEstadoInicial();

        document.getElementById('cliente_id').addEventListener('change', function () {
            actualizarTelefonoCliente(true);
        });

        document.getElementById('especialidad_id').addEventListener('change', function () {
            filtrarTecnicosPorEspecialidad();
        });

        document.getElementById('tecnico_id').addEventListener('change', function () {
            actualizarEstadoInicial();
        });
    });
</script>

@endsection