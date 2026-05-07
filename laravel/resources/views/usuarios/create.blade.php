@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="page-header">
    <h1>Nuevo Usuario</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        <strong>No se ha podido crear el usuario.</strong>
        <ul style="margin-top: 10px; margin-bottom: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('usuarios.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            class="form-control" 
            value="{{ old('nombre') }}" 
            required
        >
    </div>

    <div class="form-group">
        <label>Email</label>
        <input 
            type="email" 
            name="email" 
            class="form-control" 
            value="{{ old('email') }}" 
            required
        >
    </div>

    <div class="form-group">
        <label>Password</label>
        <input 
            type="password" 
            name="password" 
            class="form-control" 
            required
        >
    </div>

    <div class="form-group">
        <label>Rol</label>
        <select name="rol" class="form-control" required>
            <option value="particular" {{ old('rol') == 'particular' ? 'selected' : '' }}>
                Particular
            </option>
            <option value="tecnico" {{ old('rol') == 'tecnico' ? 'selected' : '' }}>
                Técnico
            </option>
            <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>
                Admin
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>Teléfono</label>
        <input 
            type="text" 
            name="telefono" 
            class="form-control" 
            value="{{ old('telefono') }}"
        >
    </div>

    <button type="submit" class="btn btn-primary">
        Crear usuario
    </button>

    <a href="{{ route('usuarios.index') }}" class="btn btn-warning">
        Volver
    </a>

</form>

@endsection