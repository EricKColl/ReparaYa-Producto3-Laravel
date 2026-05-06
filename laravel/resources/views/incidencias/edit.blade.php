<h1>Editar Incidencia</h1>

<form action="{{ route('incidencias.update', $incidencia->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Cliente:</label>
    <select name="cliente_id">
        @foreach ($clientes as $u)
            <option value="{{ $u->id }}"
                {{ $incidencia->cliente_id == $u->id ? 'selected' : '' }}>
                {{ $u->nombre }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Técnico:</label>
    <select name="tecnico_id">
        @foreach ($tecnicos as $t)
            <option value="{{ $t->id }}"
                {{ $incidencia->tecnico_id == $t->id ? 'selected' : '' }}>
                {{ $t->nombre_completo }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Especialidad:</label>
    <select name="especialidad_id">
        @foreach ($especialidades as $e)
            <option value="{{ $e->id }}"
                {{ $incidencia->especialidad_id == $e->id ? 'selected' : '' }}>
                {{ $e->nombre_especialidad }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Descripción:</label>
    <textarea name="descripcion">{{ $incidencia->descripcion }}</textarea>

    <br><br>

    <label>Dirección:</label>
    <input type="text"
           name="direccion"
           value="{{ $incidencia->direccion }}">

    <br><br>

    <label>Teléfono contacto:</label>
    <input type="text"
           name="telefono_contacto"
           value="{{ $incidencia->telefono_contacto }}">

    <br><br>

    <label>Fecha servicio:</label>
    <input type="date"
           name="fecha_servicio"
           value="{{ \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('Y-m-d') }}"

    <br><br>

    <label>Tipo urgencia:</label>
    <select name="tipo_urgencia">
    <option value="Estandar" {{ $incidencia->tipo_urgencia == 'Estandar' ? 'selected' : '' }}>Estándar</option>
    <option value="Urgente" {{ $incidencia->tipo_urgencia == 'Urgente' ? 'selected' : '' }}>Urgente</option>
    </select>

    <br><br>

   <label>Estado:</label>
    <select name="estado">
    <option value="Pendiente" {{ $incidencia->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
    <option value="Asignada" {{ $incidencia->estado == 'Asignada' ? 'selected' : '' }}>Asignada</option>
    <option value="Finalizada" {{ $incidencia->estado == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
    <option value="Cancelada" {{ $incidencia->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>

    <br><br>

    <button type="submit">Actualizar incidencia</button>
</form>

<br>

<a href="{{ route('incidencias.index') }}">
    Volver
</a>