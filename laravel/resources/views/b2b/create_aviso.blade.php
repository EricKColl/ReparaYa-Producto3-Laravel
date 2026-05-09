@extends('layouts.app')

@section('title', 'Crear Aviso')

@section('content')

<div class="page-header">
    <h1>Crear Aviso</h1>
    <a href="{{ route('b2b.panel') }}" class="btn btn-primary">← Volver al panel</a>
</div>

@if($errors->any())
<div style="background:#f8d7da; padding:10px; border-radius:6px; margin-bottom:15px; color:#842029;">
    <ul style="margin:0; padding-left:20px;">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('b2b.store_aviso') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Comunidad</label>
        <select name="comunidad_id" class="form-control" required>
            <option value="">-- Seleccionar comunidad --</option>
            @foreach($comunidades as $comunidad)
            <option value="{{ $comunidad->id }}" {{ old('comunidad_id') == $comunidad->id ? 'selected' : '' }}>
                {{ $comunidad->nombre }} ({{ $comunidad->direccion }})
            </option>
            @endforeach
        </select>
        @if($comunidades->isEmpty())
        <small style="color:#dc3545;">No tienes comunidades asignadas. Contacta con el administrador.</small>
        @endif
    </div>
    <div class="form-group">
        <label>Especialidad</label>
        <select name="especialidad_id" class="form-control" required>
            <option value="">-- Seleccionar especialidad --</option>
            @foreach($especialidades as $especialidad)
            <option value="{{ $especialidad->id }}" {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                {{ $especialidad->nombre_especialidad }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Descripción del problema</label>
        <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
    </div>

    <div class="form-group">
        <label>Teléfono de contacto</label>
        <input type="text" name="telefono_contacto" class="form-control"
            value="{{ old('telefono_contacto') }}" required>
    </div>

    <div class="form-group">
        <label>Fecha del servicio</label>
        <input type="date" name="fecha_servicio" class="form-control"
            value="{{ old('fecha_servicio') }}" required>
    </div>

    <div class="form-group">
        <label>Urgencia</label>
        <select name="tipo_urgencia" class="form-control" required>
            <option value="Estandar" {{ old('tipo_urgencia') == 'Estandar' ? 'selected' : '' }}>Estándar</option>
            <option value="Urgente" {{ old('tipo_urgencia') == 'Urgente'  ? 'selected' : '' }}>Urgente</option>
        </select>
    </div>

    <div class="form-group">
        <label>Precio base del servicio (€)</label>
        <input type="number" name="precio_base" class="form-control" step="0.01" min="0"
            value="{{ old('precio_base', 0) }}" required>
        <small style="color:#666;">La comisión se calculará automáticamente según el porcentaje acordado.</small>
    </div>

    <button type="submit" class="btn btn-primary">Enviar Aviso</button>
</form>

@endsection