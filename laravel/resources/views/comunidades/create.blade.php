@extends('layouts.app')

@section('title', 'Nueva Comunidad')

@section('content')

<div class="page-header">
    <h1>Nueva Comunidad</h1>
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

<form action="{{ route('comunidades.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Gestora</label>
        <select name="gestora_id" class="form-control" required>
            <option value="">-- Seleccionar gestora --</option>
            @foreach($gestoras as $gestora)
                <option value="{{ $gestora->id }}" {{ old('gestora_id') == $gestora->id ? 'selected' : '' }}>
                    {{ $gestora->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Nombre de la comunidad</label>
        <input type="text" name="nombre" class="form-control"
               placeholder="ej: Comunidad Calle Goya 10"
               value="{{ old('nombre') }}" required>
    </div>

    <div class="form-group">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control"
               placeholder="ej: Calle Goya 10, Madrid"
               value="{{ old('direccion') }}" required>
    </div>

    <div class="form-group">
        <label>Zona</label>
        <input type="text" name="zona" class="form-control"
               placeholder="ej: Centro, Norte, Sur..."
               value="{{ old('zona') }}" required>
        <small style="color:#64748b;">La zona se usa para agrupar servicios en la API.</small>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Comunidad</button>
</form>

@endsection
