<h1>Editar Técnico</h1>

<form method="POST" action="{{ route('tecnicos.update', $tecnico->id) }}">
    @csrf
    @method('PUT')

    <label>Usuario:</label>
    <select name="usuario_id">
        @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $tecnico->usuario_id == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->nombre }} - {{ $usuario->email }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Nombre completo:</label>
    <input type="text" name="nombre_completo" value="{{ old('nombre_completo', $tecnico->nombre_completo) }}">

    <br><br>

    <label>Especialidad:</label>
    <select name="especialidad_id">
        @foreach ($especialidades as $especialidad)
            <option value="{{ $especialidad->id }}" {{ $tecnico->especialidad_id == $especialidad->id ? 'selected' : '' }}>
                {{ $especialidad->nombre_especialidad }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Disponible:</label>
    <select name="disponible">
        <option value="1" {{ $tecnico->disponible == 1 ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ $tecnico->disponible == 0 ? 'selected' : '' }}>No</option>
    </select>

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>

<a href="{{ route('tecnicos.index') }}">Volver al listado</a>