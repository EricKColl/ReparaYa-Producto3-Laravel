@extends('layouts.app')

@section('title', 'Panel Gestora')

@section('content')

<div class="page-header">
    <h1>Panel: {{ $gestora->nombre }}</h1>
    <div>
        <a href="{{ route('b2b.create_aviso') }}" class="btn btn-primary">+ Crear Aviso</a>
        <a href="{{ route('b2b.logout') }}" class="btn btn-danger" style="margin-left:8px;">Salir</a>
    </div>
</div>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div style="background:#d1e7dd; padding:10px; border-radius:6px; margin-bottom:15px; color:#0f5132;">
        {{ session('success') }}
    </div>
@endif

{{-- Filtro por mes/año --}}
<form method="GET" action="{{ route('b2b.panel') }}"
      style="display:flex; gap:12px; align-items:flex-end; margin-bottom:20px;">
    <div>
        <label style="display:block; font-weight:bold; margin-bottom:4px;">Mes</label>
        <select name="mes" class="form-control" style="width:auto;">
            @foreach(range(1,12) as $m)
                <option value="{{ $m }}" {{ $m == $mes ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label style="display:block; font-weight:bold; margin-bottom:4px;">Año</label>
        <select name="anyo" class="form-control" style="width:auto;">
            @foreach($anyos as $a)
                <option value="{{ $a }}" {{ $a == $anyo ? 'selected' : '' }}>{{ $a }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>

{{-- Resumen del mes --}}
<div style="background:#e7f1ff; padding:15px; border-radius:8px; margin-bottom:20px;">
    <strong>Comisión total del mes (servicios finalizados):</strong>
    <span style="font-size:22px; color:#0d6efd; margin-left:10px;">{{ number_format($totalComisiones, 2) }} €</span>
    <small style="color:#555; margin-left:8px;">({{ $gestora->comision }}% sobre precio base)</small>
</div>

{{-- Tabla de servicios --}}
@if($serviciosConComision->isEmpty())
    <p class="alert-empty">No hay servicios en este período.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Localizador</th>
                <th>Comunidad</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Precio Base</th>
                <th>Comisión ({{ $gestora->comision }}%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviciosConComision as $servicio)
            <tr>
                <td>{{ $servicio->localizador }}</td>
                <td>{{ $servicio->comunidad->nombre ?? '-' }}</td>
                <td>{{ Str::limit($servicio->descripcion, 50) }}</td>
                <td>{{ $servicio->fecha_servicio }}</td>
                <td>
                    {{-- Badge de color según el estado --}}
                    @php
                        $colores = [
                            'Pendiente'  => '#ffc107',
                            'Asignada'   => '#0d6efd',
                            'Finalizada' => '#198754',
                            'Cancelada'  => '#dc3545',
                        ];
                        $color = $colores[$servicio->estado] ?? '#999';
                    @endphp
                    <span style="background:{{ $color }}; color:white; padding:3px 8px; border-radius:12px; font-size:12px;">
                        {{ $servicio->estado }}
                    </span>
                </td>
                <td>{{ number_format($servicio->precio_base, 2) }} €</td>
                <td>
                    @if($servicio->estado === 'Finalizada')
                        <strong style="color:#198754;">{{ number_format($servicio->comision_calculada, 2) }} €</strong>
                    @else
                        <span style="color:#999;">Pendiente</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
