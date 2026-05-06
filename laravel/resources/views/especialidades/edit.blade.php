<h1>Editar Especialidad</h1>

<form method="POST" action="{{ route('especialidades.update', $especialidad->id) }}">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="nombre_especialidad" value="{{ $especialidad->nombre_especialidad }}">

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>

<a href="{{ route('especialidades.index') }}">Volver</a>