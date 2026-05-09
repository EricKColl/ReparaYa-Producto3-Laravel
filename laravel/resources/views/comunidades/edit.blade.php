@extends('layouts.app')

@section('title', 'Editar Comunidad')

@section('content')

<div class="page-header">
    <h1>Editar Comunidad</h1>
    <a href="{{ route('comunidades.index') }}" class="btn btn-primary">← Volver</a>
</div>

@if($errors->any())
    <div class="flash-message flash-error">
        <ul style="margin:0; padding-left:20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('comunidades.update', $comunidad->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Gestora</label>
        <select name="gestora_id" class="form-control" required>
            <option value="">-- Seleccionar gestora --</option>
            @foreach($gestoras as $gestora)
                <option value="{{ $gestora->id }}"
                    {{ old('gestora_id', $comunidad->gestora_id) == $gestora->id ? 'selected' : '' }}>
                    {{ $gestora->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Nombre de la comunidad</label>
        <input type="text" name="nombre" class="form-control"
               value="{{ old('nombre', $comunidad->nombre) }}" required>
    </div>

    <div class="form-group">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control"
               value="{{ old('direccion', $comunidad->direccion) }}" required>
    </div>

    <div class="form-group">
        <label>Zona</label>
        <input type="text" name="zona" class="form-control"
               value="{{ old('zona', $comunidad->zona) }}" required>
    </div>

    <button type="submit" class="btn btn-warning">Actualizar</button>
</form>

@endsection
