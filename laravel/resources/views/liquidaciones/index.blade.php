@extends('layouts.app')

@section('title', 'Liquidaciones B2B')

@section('content')

<div class="page-header">
    <h1>Liquidaciones a Gestoras</h1>
</div>

<p style="color:#555; margin-bottom:20px;">
    Importe total que ReparaYa debe liquidar a cada gestora por los servicios <strong>finalizados</strong> en el período seleccionado.
</p>

{{-- Filtro mes/año --}}
<form method="GET" action="{{ route('liquidaciones.index') }}"
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

@if($liquidaciones->isEmpty() || $liquidaciones->every(fn($l) => $l['total_servicios'] === 0))
    <p class="alert-empty">No hay servicios finalizados en este período.</p>
@else
    {{-- Resumen total --}}
    @php
        $granTotal = $liquidaciones->sum('total_comision');
    @endphp
    <div style="background:#e7f1ff; padding:15px; border-radius:8px; margin-bottom:20px;">
        <strong>Total a liquidar este mes:</strong>
        <span style="font-size:22px; color:#0d6efd; margin-left:10px;">{{ number_format($granTotal, 2) }} €</span>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Gestora</th>
                <th>Email</th>
                <th>Comisión pactada</th>
                <th>Servicios finalizados</th>
                <th>Importe total servicios</th>
                <th>Total a liquidar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($liquidaciones as $liq)
                @if($liq['total_servicios'] > 0)
                <tr>
                    <td>{{ $liq['gestora']->nombre }}</td>
                    <td>{{ $liq['gestora']->email }}</td>
                    <td>{{ $liq['gestora']->comision }}%</td>
                    <td>{{ $liq['total_servicios'] }}</td>
                    <td>{{ number_format($liq['total_importe'], 2) }} €</td>
                    <td>
                        <strong style="color:#198754; font-size:16px;">
                            {{ number_format($liq['total_comision'], 2) }} €
                        </strong>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background:#f1f3f5; font-weight:bold;">
                <td colspan="5" style="text-align:right;">TOTAL A PAGAR:</td>
                <td style="color:#0d6efd; font-size:18px;">{{ number_format($granTotal, 2) }} €</td>
            </tr>
        </tfoot>
    </table>
@endif

@endsection
