<h1>Nueva Incidencia</h1>

<form action="{{ route('incidencias.store') }}" method="POST">
    @csrf

    <label>Cliente:</label>
    <select name="cliente_id">
        @foreach ($clientes as $u)
            <option value="{{ $u->id }}">{{ $u->nombre }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Técnico:</label>
    <select name="tecnico_id">
        @foreach ($tecnicos as $t)
            <option value="{{ $t->id }}">
                {{ $t->nombre_completo }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Especialidad:</label>
    <select name="especialidad_id">
        @foreach ($especialidades as $e)
            <option value="{{ $e->id }}">
                {{ $e->nombre_especialidad }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea>

    <br><br>

    <label>Dirección:</label>
    <input type="text" name="direccion">

    <br><br>

    <label>Teléfono contacto:</label>
    <input type="text" name="telefono_contacto">

    <br><br>

    <label>Fecha servicio:</label>
    <input type="date" name="fecha_servicio">

    <br><br>

     <label>Tipo urgencia:</label>
    <select name="tipo_urgencia">
    <option value="Estandar">Estándar</option>
    <option value="Urgente">Urgente</option>
    </select>

    <br><br>

    <label>Estado:</label>
    <select name="estado">
    <option value="Pendiente">Pendiente</option>
    <option value="Asignada">Asignada</option>
    <option value="Finalizada">Finalizada</option>
    <option value="Cancelada">Cancelada</option>
    </select>

    <br><br>

    <button type="submit">Crear incidencia</button>
</form>

<br>

<a href="{{ route('incidencias.index') }}">
    Volver
</a>