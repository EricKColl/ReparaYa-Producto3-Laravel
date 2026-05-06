@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

<div class="page-header">
    <h1>Editar Usuario</h1>
</div>

<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $usuario->nombre }}"
               required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control"
               value="{{ $usuario->email }}"
               required>
    </div>

    <div class="form-group">
        <label>Rol</label>

        <select name="rol" class="form-control">

            <option value="particular"
                {{ $usuario->rol == 'particular' ? 'selected' : '' }}>
                Particular
            </option>

            <option value="admin"
                {{ $usuario->rol == 'admin' ? 'selected' : '' }}>
                Admin
            </option>

        </select>
    </div>

    <div class="form-group">
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               class="form-control"
               value="{{ $usuario->telefono }}">
    </div>

    <button type="submit" class="btn btn-primary">
        Actualizar usuario
    </button>

    <a href="{{ route('usuarios.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

@endsection