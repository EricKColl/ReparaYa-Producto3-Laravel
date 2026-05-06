@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="page-header">
    <h1>Nuevo Usuario</h1>
</div>

<form action="{{ route('usuarios.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Rol</label>

        <select name="rol" class="form-control">
            <option value="particular">Particular</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Crear usuario
    </button>

    <a href="{{ route('usuarios.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

@endsection