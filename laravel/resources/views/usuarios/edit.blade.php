<h1>Editar Usuario</h1>

<form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}">
    @error('nombre') <p style="color:red;">{{ $message }}</p> @enderror

    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $usuario->email) }}">
    @error('email') <p style="color:red;">{{ $message }}</p> @enderror

    <br><br>

    <label>Nueva contraseña:</label>
    <input type="password" name="password">
    <p>Déjala vacía si no quieres cambiarla.</p>
    @error('password') <p style="color:red;">{{ $message }}</p> @enderror

    <br>

    <label>Rol:</label>
    <select name="rol">
        <option value="particular" {{ $usuario->rol == 'particular' ? 'selected' : '' }}>Particular</option>
        <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    <br><br>

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>

<a href="{{ route('usuarios.index') }}">Volver al listado</a>