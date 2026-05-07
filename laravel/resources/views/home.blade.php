@extends('layouts.app')

@section('title', 'Inicio · ReparaYa')

@section('content')

@php
    $t = $dashboard['totales'];
    $p = $dashboard['porcentajes'];
    $panel = $panelUsuario;
@endphp

<style>
    .home-shell {
        display: grid;
        gap: 30px;
    }

    .hero-wide {
        position: relative;
        overflow: hidden;
        border-radius: 34px;
        padding: 44px 34px 34px;
        background:
            radial-gradient(circle at 10% 20%, rgba(86, 199, 255, 0.14), transparent 24%),
            radial-gradient(circle at 90% 18%, rgba(214, 184, 109, 0.10), transparent 18%),
            linear-gradient(135deg, #031121 0%, #041a33 52%, #08284b 100%);
        border: 1px solid rgba(255,255,255,0.10);
        box-shadow: 0 30px 70px rgba(2, 6, 23, 0.24);
    }

    .hero-wide::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 38px 38px;
        mask-image: radial-gradient(circle at center, black 0%, transparent 86%);
    }

    .hero-top {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 1600px;
        margin: 0 auto;
    }

    .hero-title {
        margin: 0 auto 22px;
        max-width: 1680px;
        color: white;
        font-size: clamp(58px, 6.4vw, 108px);
        line-height: 0.94;
        letter-spacing: -3.8px;
        text-align: center;
    }

    .hero-title strong {
        background: linear-gradient(135deg, #ffffff 0%, #dcecff 28%, #7fd4ff 64%, #e7d49c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-subtitle {
        max-width: 1220px;
        margin: 0 auto;
        color: #d7e5f3;
        font-size: 22px;
        line-height: 1.8;
        text-align: center;
    }

    .hero-subtitle .humor {
        color: #9adfff;
        font-weight: 700;
    }

    .hero-logo-integrated {
        position: relative;
        z-index: 2;
        display: grid;
        justify-items: center;
        margin: 34px auto 24px;
    }

    .hero-logo-wrap {
        position: relative;
        width: 250px;
        height: 250px;
        display: grid;
        place-items: center;
    }

    .hero-logo-wrap::before {
        content: "";
        position: absolute;
        inset: -10px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(15, 111, 255, 0.24), transparent 68%);
        filter: blur(12px);
    }

    .hero-logo-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 1px solid rgba(86, 199, 255, 0.18);
        box-shadow: 0 0 34px rgba(86, 199, 255, 0.14);
    }

    .hero-logo-ring::before {
        content: "";
        position: absolute;
        inset: 18px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .hero-logo-mark {
        position: relative;
        z-index: 1;
        width: 172px;
        height: 172px;
        border-radius: 32px;
        display: grid;
        place-items: center;
        color: white;
        font-size: 66px;
        font-weight: 900;
        letter-spacing: -3px;
        background: linear-gradient(135deg, #0f6fff, #56c7ff);
        box-shadow:
            0 22px 44px rgba(15, 111, 255, 0.28),
            inset 0 1px 0 rgba(255,255,255,0.14);
    }

    .hero-main-card {
        position: relative;
        z-index: 2;
        max-width: 1480px;
        margin: 0 auto;
        border-radius: 28px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.10);
        backdrop-filter: blur(12px);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.05);
        padding: 34px 30px 30px;
    }

    .hero-card-head {
        text-align: center;
        margin-bottom: 26px;
    }

    .hero-card-head h2 {
        margin: 0 0 14px;
        color: white;
        font-size: 36px;
        line-height: 1.12;
        letter-spacing: -1px;
    }

    .hero-card-head p {
        margin: 0 auto;
        max-width: 1100px;
        color: #d5e3f0;
        font-size: 17px;
        line-height: 1.85;
    }

    .hero-card-grid {
        display: grid;
        gap: 22px;
    }

    .hero-points {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .hero-point {
        padding: 22px 18px 18px;
        border-radius: 20px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        min-height: 154px;
    }

    .hero-point strong {
        display: block;
        margin-bottom: 10px;
        color: white;
        font-size: 17px;
    }

    .hero-point span {
        display: block;
        color: #ccdae8;
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 8px;
    }

    .hero-btn-secondary {
        background: rgba(255,255,255,0.10);
        color: white;
        border: 1px solid rgba(255,255,255,0.14);
    }

    .role-panel {
        position: relative;
        overflow: hidden;
        border-radius: 34px;
        padding: 34px;
        background:
            radial-gradient(circle at 8% 12%, rgba(86,199,255,0.12), transparent 22%),
            radial-gradient(circle at 92% 10%, rgba(214,184,109,0.10), transparent 20%),
            linear-gradient(135deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 22px 46px rgba(15,23,42,0.08);
    }

    .role-panel::before {
        content: "";
        position: absolute;
        right: -110px;
        top: -110px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(15,111,255,0.12), transparent 68%);
        pointer-events: none;
    }

    .role-panel-head {
        position: relative;
        z-index: 2;
        display: grid;
        justify-items: center;
        text-align: center;
        gap: 12px;
        margin-bottom: 26px;
    }

    .role-panel-head h2 {
        margin: 0;
        color: #0f172a;
        font-size: 38px;
        line-height: 1.08;
        letter-spacing: -1.2px;
    }

    .role-panel-head p {
        margin: 0;
        max-width: 850px;
        color: #61748c;
        font-size: 17px;
        line-height: 1.75;
    }

    .role-actions {
        margin-top: 8px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .role-metrics {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 26px;
    }

    .role-metric-card {
        padding: 22px;
        border-radius: 24px;
        background: rgba(255,255,255,0.86);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 16px 32px rgba(15,23,42,0.07);
    }

    .role-metric-card span {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.45px;
        text-transform: uppercase;
    }

    .role-metric-card strong {
        display: block;
        margin-top: 8px;
        color: #0f172a;
        font-size: 42px;
        line-height: 1;
        letter-spacing: -1.5px;
    }

    .role-metric-card small {
        display: block;
        margin-top: 10px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.55;
    }

    .dashboard-zone {
        position: relative;
        overflow: hidden;
        border-radius: 34px;
        padding: 32px;
        background:
            radial-gradient(circle at 8% 12%, rgba(86,199,255,0.14), transparent 22%),
            radial-gradient(circle at 92% 10%, rgba(214,184,109,0.12), transparent 20%),
            linear-gradient(135deg, #041225 0%, #061a32 52%, #0b2748 100%);
        border: 1px solid rgba(255,255,255,0.12);
        box-shadow: 0 30px 70px rgba(2, 6, 23, 0.22);
    }

    .dashboard-zone::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 38px 38px;
        pointer-events: none;
    }

    .dashboard-head {
        position: relative;
        z-index: 2;
        margin-bottom: 28px;
        text-align: center;
    }

    .dashboard-head h2 {
        margin: 0;
        color: white;
        font-size: 42px;
        letter-spacing: -1.3px;
        text-align: center;
    }

    .dashboard-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .metric-card {
        padding: 22px;
        border-radius: 24px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.12);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
    }

    .metric-card span {
        display: block;
        color: #9fb5d1;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 900;
    }

    .metric-card strong {
        display: block;
        margin-top: 8px;
        color: white;
        font-size: 42px;
        line-height: 1;
        letter-spacing: -1.5px;
    }

    .metric-card small {
        display: block;
        margin-top: 10px;
        color: #d5e2ef;
        font-size: 14px;
        line-height: 1.55;
    }

    .analytics-layout {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        gap: 18px;
        margin-top: 18px;
    }

    .chart-panel {
        padding: 26px;
        border-radius: 26px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.12);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
    }

    .chart-panel h3 {
        margin: 0 0 20px;
        color: white;
        font-size: 24px;
        letter-spacing: -0.7px;
    }

    .donut-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .donut-card {
        display: grid;
        justify-items: center;
        gap: 12px;
        padding: 18px;
        border-radius: 22px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.10);
        text-align: center;
    }

    .donut {
        width: 122px;
        height: 122px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background:
            radial-gradient(circle at center, #061a32 0 54%, transparent 55%),
            conic-gradient(#56c7ff calc(var(--value) * 1%), rgba(255,255,255,0.12) 0);
        box-shadow: 0 18px 36px rgba(0,0,0,0.18);
    }

    .donut.gold {
        background:
            radial-gradient(circle at center, #061a32 0 54%, transparent 55%),
            conic-gradient(#d6b86d calc(var(--value) * 1%), rgba(255,255,255,0.12) 0);
    }

    .donut.green {
        background:
            radial-gradient(circle at center, #061a32 0 54%, transparent 55%),
            conic-gradient(#19b36b calc(var(--value) * 1%), rgba(255,255,255,0.12) 0);
    }

    .donut strong {
        color: white;
        font-size: 25px;
        letter-spacing: -0.7px;
    }

    .donut-card span {
        color: #d5e2ef;
        font-size: 14px;
        font-weight: 800;
    }

    .bar-list {
        display: grid;
        gap: 16px;
    }

    .bar-item {
        display: grid;
        gap: 8px;
    }

    .bar-top {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        color: #dce8f6;
        font-weight: 800;
        font-size: 14px;
    }

    .bar-track {
        height: 12px;
        border-radius: 999px;
        background: rgba(255,255,255,0.12);
        overflow: hidden;
    }

    .bar-fill {
        width: calc(var(--value) * 1%);
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #0f6fff, #56c7ff);
        box-shadow: 0 0 18px rgba(86,199,255,0.30);
    }

    .bar-fill.gold {
        background: linear-gradient(90deg, #c7972d, #f1e2b1);
    }

    .bar-fill.green {
        background: linear-gradient(90deg, #108f58, #55e6a2);
    }

    .bar-fill.red {
        background: linear-gradient(90deg, #d53f4c, #ff7b8a);
    }

    .ops-grid {
        display: grid;
        grid-template-columns: 1.08fr 0.92fr;
        gap: 20px;
    }

    .ops-panel,
    .session-panel {
        background: linear-gradient(180deg, rgba(255,255,255,0.99), rgba(248,251,255,0.98));
        border: 1px solid rgba(15,23,42,0.08);
        border-radius: 26px;
        padding: 28px;
        box-shadow: 0 18px 34px rgba(15,23,42,0.08);
    }

    .ops-panel h3,
    .session-panel h3 {
        margin: 0 0 18px;
        font-size: 26px;
        line-height: 1.1;
        letter-spacing: -0.7px;
        text-align: center;
    }

    .ops-list {
        display: grid;
        gap: 14px;
        margin-top: 22px;
    }

    .ops-item {
        display: flex;
        gap: 14px;
        padding: 16px 16px;
        border-radius: 18px;
        background: white;
        border: 1px solid rgba(15,23,42,0.08);
    }

    .ops-index {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        flex: 0 0 38px;
        border-radius: 50%;
        color: white;
        font-weight: 900;
        background: linear-gradient(135deg, #0f6fff, #56c7ff);
    }

    .ops-item strong {
        display: block;
        margin-bottom: 4px;
        color: #0f172a;
        font-size: 16px;
    }

    .ops-item span {
        color: #62748a;
        font-size: 15px;
        line-height: 1.65;
    }

    .session-data {
        display: grid;
        gap: 12px;
        margin: 22px 0 24px;
    }

    .session-data div {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(15,23,42,0.08);
    }

    .session-data span {
        color: #62748a;
        font-weight: 800;
    }

    .session-data strong {
        color: #0f172a;
        text-align: right;
        font-size: 16px;
    }

    @media (max-width: 1450px) {
        .dashboard-grid,
        .role-metrics {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .analytics-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1200px) {
        .ops-grid {
            grid-template-columns: 1fr;
        }

        .hero-points {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {
        .donut-row {
            grid-template-columns: 1fr;
        }

        .dashboard-grid,
        .role-metrics {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 760px) {
        .hero-wide,
        .dashboard-zone,
        .role-panel {
            padding: 24px 16px;
            border-radius: 24px;
        }

        .hero-title {
            font-size: clamp(40px, 12vw, 58px);
            line-height: 1;
            letter-spacing: -2px;
        }

        .hero-subtitle {
            font-size: 17px;
        }

        .hero-logo-wrap {
            width: 200px;
            height: 200px;
        }

        .hero-logo-mark {
            width: 138px;
            height: 138px;
            font-size: 50px;
        }

        .hero-main-card {
            padding: 22px 16px;
        }

        .hero-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="home-shell">

    <section class="hero-wide">
        <div class="hero-top">
            @if($tipoInicio === 'visitante')
                <h1 class="hero-title">
                    <strong>Gestiona reparaciones sin ruido, sin caos y con una imagen que inspira confianza</strong>
                </h1>

                <p class="hero-subtitle">
                    ReparaYa convierte la gestión diaria en una experiencia mucho más clara, ágil y profesional. Centraliza incidencias, técnicos, especialidades y clientes en un solo entorno para que todo fluya mejor, se responda antes y el servicio hable bien de tu marca. <span class="humor">Porque arreglar averías ya es bastante trabajo como para además pelearse con la organización.</span>
                </p>
            @elseif($tipoInicio === 'admin')
                <h1 class="hero-title">
                    <strong>Tu centro de mando para que cada reparación tenga orden, pulso y dirección</strong>
                </h1>

                <p class="hero-subtitle">
                    Una vista pensada para controlar la operativa completa: usuarios, técnicos, incidencias, disponibilidad y estado del servicio. El panel que evita que la gestión vaya por libre.
                </p>
            @elseif($tipoInicio === 'tecnico')
                <h1 class="hero-title">
                    <strong>Intervenciones claras, menos rodeos y todo listo para actuar</strong>
                </h1>

                <p class="hero-subtitle">
                    Tu área técnica reúne lo importante para trabajar con contexto, revisar servicios asignados y mantener cada actuación bajo control.
                </p>
            @else
                <h1 class="hero-title">
                    <strong>Tus reparaciones, claras desde el primer aviso hasta la solución</strong>
                </h1>

                <p class="hero-subtitle">
                    Consulta tus solicitudes, revisa el estado de cada servicio y crea nuevos avisos sin perderte entre pantallas innecesarias.
                </p>
            @endif
        </div>

        <div class="hero-logo-integrated">
            <div class="hero-logo-wrap">
                <div class="hero-logo-ring"></div>
                <div class="hero-logo-mark">RY</div>
            </div>
        </div>

        <div class="hero-main-card">
            <div class="hero-card-head">
                <h2>{{ $panel['titulo'] }}</h2>
                <p>{{ $panel['subtitulo'] }}</p>
            </div>

            <div class="hero-card-grid">
                <div class="hero-points">
                    @if($tipoInicio === 'visitante')
                        <div class="hero-point">
                            <strong>Más orden</strong>
                            <span>Todo el servicio queda estructurado con lógica y sin duplicidades innecesarias.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Más rapidez</strong>
                            <span>Accede antes a la información clave y asigna mejor cada actuación técnica.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Más confianza</strong>
                            <span>Una interfaz cuidada transmite profesionalidad tanto al equipo como al cliente.</span>
                        </div>
                    @elseif($tipoInicio === 'admin')
                        <div class="hero-point">
                            <strong>Visión global</strong>
                            <span>Controla usuarios, técnicos e incidencias desde una lectura rápida y ordenada.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Decisión rápida</strong>
                            <span>Detecta actividad abierta, carga pendiente y capacidad técnica disponible.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Gestión con criterio</strong>
                            <span>Menos intuición a ciegas y más datos para mantener el servicio en marcha.</span>
                        </div>
                    @elseif($tipoInicio === 'tecnico')
                        <div class="hero-point">
                            <strong>Trabajo asignado</strong>
                            <span>Consulta las intervenciones vinculadas a tu ficha técnica.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Estado claro</strong>
                            <span>Identifica qué está pendiente, asignado o finalizado sin perder tiempo.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Actuación enfocada</strong>
                            <span>La información importante queda delante para poder trabajar mejor.</span>
                        </div>
                    @else
                        <div class="hero-point">
                            <strong>Avisos controlados</strong>
                            <span>Revisa tus solicitudes y el estado de cada reparación.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Nuevas incidencias</strong>
                            <span>Crea avisos de reparación con una experiencia clara y guiada.</span>
                        </div>

                        <div class="hero-point">
                            <strong>Seguimiento sencillo</strong>
                            <span>Menos llamadas innecesarias y más información disponible.</span>
                        </div>
                    @endif
                </div>

                <div class="hero-actions">
                    <a href="{{ $panel['url_principal'] }}" class="btn btn-primary">
                        {{ $panel['accion_principal'] }}
                    </a>

                    @if($tipoInicio === 'visitante')
                        <a href="{{ url('/incidencias') }}" class="btn hero-btn-secondary">
                            Ver entorno
                        </a>
                    @elseif($tipoInicio === 'admin')
                        <a href="{{ url('/usuarios') }}" class="btn hero-btn-secondary">
                            Gestionar usuarios
                        </a>

                        <a href="{{ url('/tecnicos') }}" class="btn hero-btn-secondary">
                            Ver técnicos
                        </a>
                    @elseif($tipoInicio === 'tecnico')
                        <a href="{{ url('/tecnicos') }}" class="btn hero-btn-secondary">
                            Mi área técnica
                        </a>
                    @else
                        <a href="{{ url('/incidencias') }}" class="btn hero-btn-secondary">
                            Ver mis avisos
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if($tipoInicio === 'admin')
        <section class="dashboard-zone">
            <div class="dashboard-head">
                <h2>Operativa en tiempo real</h2>
            </div>

            <div class="dashboard-grid">
                <div class="metric-card">
                    <span>Usuarios registrados</span>
                    <strong>{{ $t['usuarios'] }}</strong>
                    <small>{{ $t['particulares'] }} clientes · {{ $t['usuarios_tecnicos'] }} usuarios técnicos · {{ $t['admins'] }} administradores</small>
                </div>

                <div class="metric-card">
                    <span>Técnicos</span>
                    <strong>{{ $t['tecnicos'] }}</strong>
                    <small>{{ $t['tecnicos_disponibles'] }} disponibles · {{ $p['tecnicos_disponibles'] }}% de capacidad activa</small>
                </div>

                <div class="metric-card">
                    <span>Incidencias totales</span>
                    <strong>{{ $t['incidencias'] }}</strong>
                    <small>{{ $t['incidencias_abiertas'] }} abiertas · {{ $t['finalizadas'] }} finalizadas</small>
                </div>

                <div class="metric-card">
                    <span>Especialidades</span>
                    <strong>{{ $t['especialidades'] }}</strong>
                    <small>Catálogo operativo disponible para clasificar y asignar servicios.</small>
                </div>
            </div>

            <div class="analytics-layout">
                <div class="chart-panel">
                    <h3>Indicadores clave</h3>

                    <div class="donut-row">
                        <div class="donut-card">
                            <div class="donut green" style="--value: {{ $p['resolucion'] }};">
                                <strong>{{ $p['resolucion'] }}%</strong>
                            </div>
                            <span>Resolución</span>
                        </div>

                        <div class="donut-card">
                            <div class="donut" style="--value: {{ $p['actividad_abierta'] }};">
                                <strong>{{ $p['actividad_abierta'] }}%</strong>
                            </div>
                            <span>Actividad abierta</span>
                        </div>

                        <div class="donut-card">
                            <div class="donut gold" style="--value: {{ $p['urgentes'] }};">
                                <strong>{{ $p['urgentes'] }}%</strong>
                            </div>
                            <span>Urgentes</span>
                        </div>
                    </div>
                </div>

                <div class="chart-panel">
                    <h3>Estado de incidencias</h3>

                    <div class="bar-list">
                        <div class="bar-item">
                            <div class="bar-top">
                                <span>Pendientes</span>
                                <span>{{ $t['pendientes'] }} · {{ $p['pendientes'] }}%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill gold" style="--value: {{ $p['pendientes'] }};"></div>
                            </div>
                        </div>

                        <div class="bar-item">
                            <div class="bar-top">
                                <span>Asignadas</span>
                                <span>{{ $t['asignadas'] }} · {{ $p['asignadas'] }}%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: {{ $p['asignadas'] }};"></div>
                            </div>
                        </div>

                        <div class="bar-item">
                            <div class="bar-top">
                                <span>Finalizadas</span>
                                <span>{{ $t['finalizadas'] }} · {{ $p['finalizadas'] }}%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill green" style="--value: {{ $p['finalizadas'] }};"></div>
                            </div>
                        </div>

                        <div class="bar-item">
                            <div class="bar-top">
                                <span>Canceladas</span>
                                <span>{{ $t['canceladas'] }} · {{ $p['canceladas'] }}%</span>
                            </div>
                            <div class="bar-track">
                                <div class="bar-fill red" style="--value: {{ $p['canceladas'] }};"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="role-panel">
            <div class="role-panel-head">
                <h2>{{ $panel['titulo'] }}</h2>
                <p>{{ $panel['subtitulo'] }}</p>

                <div class="role-actions">
                    <a href="{{ $panel['url_principal'] }}" class="btn btn-primary">
                        {{ $panel['accion_principal'] }}
                    </a>
                </div>
            </div>

            @if(!empty($panel['metricas']))
                <div class="role-metrics">
                    @foreach($panel['metricas'] as $nombre => $valor)
                        <div class="role-metric-card">
                            <span>{{ str_replace('_', ' ', ucfirst($nombre)) }}</span>
                            <strong>{{ $valor }}</strong>
                            <small>Información vinculada a tu actividad en ReparaYa.</small>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    <section class="ops-grid">
        <div class="ops-panel">
            <h3>Flujo operativo del servicio</h3>

            <div class="ops-list">
                <div class="ops-item">
                    <div class="ops-index">1</div>
                    <div>
                        <strong>Registro del aviso</strong>
                        <span>La incidencia se crea con la información necesaria para actuar con criterio desde el inicio.</span>
                    </div>
                </div>

                <div class="ops-item">
                    <div class="ops-index">2</div>
                    <div>
                        <strong>Asignación y planificación</strong>
                        <span>El servicio se organiza de forma coherente según especialidad, disponibilidad y prioridad.</span>
                    </div>
                </div>

                <div class="ops-item">
                    <div class="ops-index">3</div>
                    <div>
                        <strong>Seguimiento y cierre</strong>
                        <span>El estado de cada actuación queda bajo control hasta su resolución final.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="session-panel">
            @if($usuario)
                <h3>Acceso operativo habilitado</h3>

                <div class="session-data">
                    <div>
                        <span>ID de usuario</span>
                        <strong>{{ $usuario['id'] }}</strong>
                    </div>

                    <div>
                        <span>Nombre</span>
                        <strong>{{ $usuario['nombre'] }}</strong>
                    </div>

                    <div>
                        <span>Rol</span>
                        <strong>
                            @if($usuario['rol'] === 'tecnico')
                                Técnico
                            @elseif($usuario['rol'] === 'admin')
                                Administrador
                            @else
                                Particular
                            @endif
                        </strong>
                    </div>
                </div>

                <a href="{{ url('/logout') }}" class="btn btn-danger">
                    Cerrar sesión
                </a>
            @else
                <h3>Accede al entorno de gestión</h3>

                <div class="session-data">
                    <div>
                        <span>Estado</span>
                        <strong>Sin autenticación</strong>
                    </div>

                    <div>
                        <span>Disponibilidad</span>
                        <strong>Acceso habilitado</strong>
                    </div>

                    <div>
                        <span>Entorno</span>
                        <strong>Listo para operar</strong>
                    </div>
                </div>

                <a href="{{ url('/login') }}" class="btn btn-primary">
                    Ir al login
                </a>
            @endif
        </div>
    </section>

</div>

@endsection