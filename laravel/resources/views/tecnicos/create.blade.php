<h1>Nuevo Técnico</h1>

<form method="POST" action="{{ route('tecnicos.store') }}">
    @csrf

    <label>Usuario:</label>
    <select name="usuario_id">
        @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->nombre }} - {{ $usuario->email }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Nombre completo:</label>
    <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}">

    @error('nombre_completo')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <br><br>

    <label>Especialidad:</label>
    <select name="especialidad_id">
        @foreach ($especialidades as $especialidad)
            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre_especialidad }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Disponible:</label>
    <select name="disponible">
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select>

    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>

<a href="{{ route('tecnicos.index') }}">Volver al listado</a>