@extends('layouts.app')

@section('title', 'Editar Incidencia')

@section('content')

<div class="page-header">
    <h1>Editar Incidencia</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        <strong>No se ha podido actualizar la incidencia.</strong>
        <ul style="margin-top: 10px; margin-bottom: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('incidencias.update', $incidencia->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Cliente</label>

        <select name="cliente_id" id="cliente_id" class="form-control" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                        data-telefono="{{ $cliente->telefono ?? '' }}"
                        {{ old('cliente_id', $incidencia->cliente_id) == $cliente->id ? 'selected' : '' }}>
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
                        {{ old('especialidad_id', $incidencia->especialidad_id) == $especialidad->id ? 'selected' : '' }}>
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
                        {{ old('tecnico_id', $incidencia->tecnico_id) == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->nombre_completo }}
                    @if ($tecnico->especialidad)
                        - {{ $tecnico->especialidad->nombre_especialidad }}
                    @endif
                </option>
            @endforeach
        </select>

        <small style="display:block; margin-top:6px; color:#666;">
            El técnico asignado debe coincidir con la especialidad solicitada.
        </small>
    </div>

    <div class="form-group">
        <label>Descripción</label>

        <textarea
            name="descripcion"
            class="form-control"
            rows="4"
            required>{{ old('descripcion', $incidencia->descripcion) }}</textarea>
    </div>

    <div class="form-group">
        <label>Dirección</label>

        <input type="text"
               name="direccion"
               class="form-control"
               value="{{ old('direccion', $incidencia->direccion) }}"
               required>
    </div>

    <div class="form-group">
        <label>Teléfono contacto</label>

        <input type="text"
               name="telefono_contacto"
               id="telefono_contacto"
               class="form-control"
               value="{{ old('telefono_contacto', $incidencia->telefono_contacto) }}"
               required>
    </div>

    <div class="form-group">
        <label>Fecha y hora del servicio</label>

        <input type="datetime-local"
               name="fecha_servicio"
               class="form-control"
               value="{{ old('fecha_servicio', \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('Y-m-d\TH:i')) }}"
               required>
    </div>

    <div class="form-group">
        <label>Tipo urgencia</label>

        <select name="tipo_urgencia" class="form-control" required>
            <option value="Estandar"
                {{ old('tipo_urgencia', $incidencia->tipo_urgencia) == 'Estandar' ? 'selected' : '' }}>
                Estándar
            </option>

            <option value="Urgente"
                {{ old('tipo_urgencia', $incidencia->tipo_urgencia) == 'Urgente' ? 'selected' : '' }}>
                Urgente
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>Estado</label>

        <select name="estado" id="estado" class="form-control" required>
            <option value="Pendiente"
                {{ old('estado', $incidencia->estado) == 'Pendiente' ? 'selected' : '' }}>
                Pendiente
            </option>

            <option value="Asignada"
                {{ old('estado', $incidencia->estado) == 'Asignada' ? 'selected' : '' }}>
                Asignada
            </option>

            <option value="Finalizada"
                {{ old('estado', $incidencia->estado) == 'Finalizada' ? 'selected' : '' }}>
                Finalizada
            </option>

            <option value="Cancelada"
                {{ old('estado', $incidencia->estado) == 'Cancelada' ? 'selected' : '' }}>
                Cancelada
            </option>
        </select>

        <small id="estado_ayuda" style="display:block; margin-top:6px; color:#666;"></small>
    </div>

    <button type="submit" class="btn btn-primary">
        Actualizar incidencia
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

        actualizarOpcionesEstado();
    }

    function actualizarOpcionesEstado() {
        const selectTecnico = document.getElementById('tecnico_id');
        const selectEstado = document.getElementById('estado');
        const estadoAyuda = document.getElementById('estado_ayuda');

        if (!selectTecnico || !selectEstado || !estadoAyuda) {
            return;
        }

        const hayTecnico = selectTecnico.value !== '';

        for (let i = 0; i < selectEstado.options.length; i++) {
            const opcion = selectEstado.options[i];

            opcion.hidden = false;
            opcion.disabled = false;

            if (hayTecnico && opcion.value === 'Pendiente') {
                opcion.hidden = true;
                opcion.disabled = true;
            }

            if (!hayTecnico && (opcion.value === 'Asignada' || opcion.value === 'Finalizada')) {
                opcion.hidden = true;
                opcion.disabled = true;
            }
        }

        if (hayTecnico && selectEstado.value === 'Pendiente') {
            selectEstado.value = 'Asignada';
        }

        if (!hayTecnico && (selectEstado.value === 'Asignada' || selectEstado.value === 'Finalizada')) {
            selectEstado.value = 'Pendiente';
        }

        if (hayTecnico) {
            estadoAyuda.textContent = 'Con técnico asignado, la incidencia puede estar Asignada, Finalizada o Cancelada.';
        } else {
            estadoAyuda.textContent = 'Sin técnico asignado, la incidencia solo puede quedar Pendiente o Cancelada.';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        actualizarTelefonoCliente(false);
        filtrarTecnicosPorEspecialidad();
        actualizarOpcionesEstado();

        document.getElementById('cliente_id').addEventListener('change', function () {
            actualizarTelefonoCliente(true);
        });

        document.getElementById('especialidad_id').addEventListener('change', function () {
            filtrarTecnicosPorEspecialidad();
        });

        document.getElementById('tecnico_id').addEventListener('change', function () {
            actualizarOpcionesEstado();
        });
    });
</script>

@endsection