<h1>Nueva Especialidad</h1>

<form method="POST" action="{{ route('especialidades.store') }}">
    @csrf

    <label for="nombre_especialidad">Nombre de la especialidad:</label>
    <input 
        type="text" 
        id="nombre_especialidad" 
        name="nombre_especialidad" 
        value="{{ old('nombre_especialidad') }}"
    >

    @error('nombre_especialidad')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>

<a href="{{ route('especialidades.index') }}">Volver al listado</a>