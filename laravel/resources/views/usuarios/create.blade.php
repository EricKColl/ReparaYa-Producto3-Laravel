<h1>Nuevo Usuario</h1>

<form method="POST" action="{{ route('usuarios.store') }}">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ old('nombre') }}">
    @error('nombre') <p style="color:red;">{{ $message }}</p> @enderror

    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email') <p style="color:red;">{{ $message }}</p> @enderror

    <br><br>

    <label>Contraseña:</label>
    <input type="password" name="password">
    @error('password') <p style="color:red;">{{ $message }}</p> @enderror

    <br><br>

    <label>Rol:</label>
    <select name="rol">
        <option value="particular">Particular</option>
        <option value="admin">Admin</option>
    </select>

    <br><br>

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="{{ old('telefono') }}">

    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>

<a href="{{ route('usuarios.index') }}">Volver al listado</a>