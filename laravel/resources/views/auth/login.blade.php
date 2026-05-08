@extends('layouts.app')

@section('title', 'Login · ReparaYa')

@section('content')

<style>
    .login-shell {
        min-height: calc(100vh - 250px);
        display: grid;
        place-items: center;
        padding: 18px 0;
    }

    .login-wrapper {
        width: 100%;
        max-width: 500px;
        animation: loginEnter 0.45s ease both;
    }

    @keyframes loginEnter {
        from {
            opacity: 0;
            transform: translateY(16px) scale(0.985);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .login-card {
        position: relative;
        overflow: hidden;
        border-radius: 32px;
        padding: 34px 30px 28px;
        background:
            radial-gradient(circle at top left, rgba(86, 199, 255, 0.18), transparent 25%),
            radial-gradient(circle at top right, rgba(15, 111, 255, 0.12), transparent 22%),
            radial-gradient(circle at bottom, rgba(15, 111, 255, 0.07), transparent 34%),
            linear-gradient(135deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow:
            0 28px 60px rgba(15, 23, 42, 0.12),
            0 8px 22px rgba(15, 111, 255, 0.07);
    }

    .login-card::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(rgba(15, 111, 255, 0.026) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 111, 255, 0.026) 1px, transparent 1px);
        background-size: 28px 28px;
        mask-image: radial-gradient(circle at center, black 0%, transparent 88%);
    }

    .login-card::after {
        content: "";
        position: absolute;
        top: -120px;
        left: -120px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(86, 199, 255, 0.22), transparent 68%);
        filter: blur(10px);
        pointer-events: none;
    }

    .login-head {
        position: relative;
        z-index: 2;
        text-align: center;
        margin-bottom: 28px;
    }

    .login-logo-wrap {
        position: relative;
        width: 102px;
        height: 102px;
        margin: 0 auto 18px;
        display: grid;
        place-items: center;
    }

    .login-logo-wrap::before {
        content: "";
        position: absolute;
        inset: -10px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(15, 111, 255, 0.20), transparent 68%);
        filter: blur(9px);
    }

    .login-logo-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 1px solid rgba(15, 111, 255, 0.16);
        box-shadow: 0 0 26px rgba(86, 199, 255, 0.16);
    }

    .login-logo-ring::before {
        content: "";
        position: absolute;
        inset: 13px;
        border-radius: 50%;
        border: 1px solid rgba(15, 111, 255, 0.10);
    }

    .login-logo {
        position: relative;
        z-index: 2;
        width: 74px;
        height: 74px;
        border-radius: 22px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #0f6fff, #56c7ff);
        color: white;
        font-size: 28px;
        font-weight: 900;
        letter-spacing: -1px;
        box-shadow:
            0 18px 34px rgba(15, 111, 255, 0.26),
            inset 0 1px 0 rgba(255,255,255,0.20);
    }

    .login-title {
        margin: 0;
        color: #0f172a;
        font-size: 38px;
        line-height: 1.05;
        letter-spacing: -1.3px;
    }

    .login-alert {
        position: relative;
        z-index: 2;
        margin-bottom: 18px;
        padding: 15px 16px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.6;
        font-weight: 700;
        background: #fff0f2;
        color: #9f1d2e;
        border: 1px solid rgba(220, 53, 69, 0.20);
    }

    .login-alert strong {
        display: block;
        margin-bottom: 6px;
    }

    .login-alert ul {
        margin: 8px 0 0;
        padding-left: 18px;
    }

    .login-form {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 18px;
    }

    .login-field {
        display: grid;
        gap: 8px;
    }

    .login-label {
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: -0.2px;
    }

    .login-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .login-icon {
        position: absolute;
        left: 16px;
        width: 20px;
        height: 20px;
        display: grid;
        place-items: center;
        color: #64748b;
        pointer-events: none;
        z-index: 2;
    }

    .login-icon svg {
        width: 18px;
        height: 18px;
        display: block;
    }

    .login-input {
        width: 100%;
        min-height: 56px;
        padding: 15px 18px 15px 48px;
        border: 1px solid #d7e0ea;
        border-radius: 18px;
        background: rgba(255,255,255,0.96);
        font-size: 15px;
        color: #0f172a;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.60);
        transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease, background 0.15s ease;
    }

    .login-input.password-field {
        padding-right: 108px;
    }

    .login-input::placeholder {
        color: #8a99ad;
    }

    .login-input:focus {
        outline: none;
        border-color: rgba(15, 111, 255, 0.48);
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(15, 111, 255, 0.10),
            0 10px 22px rgba(15, 111, 255, 0.07);
        transform: translateY(-1px);
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        border: none;
        background: rgba(15, 111, 255, 0.08);
        color: #0f6fff;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.2px;
        border-radius: 999px;
        padding: 10px 14px;
        cursor: pointer;
        transition: background 0.15s ease, transform 0.15s ease;
    }

    .toggle-password:hover {
        background: rgba(15, 111, 255, 0.14);
        transform: translateY(-1px);
    }

    .login-actions {
        margin-top: 4px;
    }

    .login-btn {
        position: relative;
        width: 100%;
        min-height: 56px;
        border: none;
        border-radius: 18px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 900;
        letter-spacing: -0.3px;
        color: white;
        background: linear-gradient(135deg, #0f6fff, #56c7ff);
        box-shadow: 0 14px 28px rgba(15, 111, 255, 0.20);
        transition: transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
        overflow: hidden;
    }

    .login-btn::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, transparent 0%, rgba(255,255,255,0.22) 45%, transparent 62%);
        transform: translateX(-120%);
        transition: transform 0.45s ease;
    }

    .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 34px rgba(15, 111, 255, 0.25);
    }

    .login-btn:hover::before {
        transform: translateX(120%);
    }

    .login-btn.is-loading {
        cursor: wait;
        filter: saturate(0.92);
    }

    .login-btn-text {
        position: relative;
        z-index: 2;
    }

    @media (max-width: 640px) {
        .login-shell {
            min-height: auto;
            padding: 8px 0 4px;
        }

        .login-card {
            padding: 24px 18px 22px;
            border-radius: 24px;
        }

        .login-title {
            font-size: 31px;
        }

        .toggle-password {
            padding: 9px 12px;
            font-size: 11px;
        }

        .login-input.password-field {
            padding-right: 96px;
        }
    }
</style>

<div class="login-shell">
    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-head">
                <div class="login-logo-wrap">
                    <div class="login-logo-ring"></div>
                    <div class="login-logo">RY</div>
                </div>

                <h1 class="login-title">Iniciar sesión</h1>
            </div>

            @if(session('error'))
                <div class="login-alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="login-alert">
                    <strong>No se ha podido iniciar sesión.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="login-form" id="loginForm">
                @csrf

                <div class="login-field">
                    <label for="email" class="login-label">Correo electrónico</label>

                    <div class="login-input-wrap">
                        <span class="login-icon">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 6.8C4 5.8 4.8 5 5.8 5h12.4C19.2 5 20 5.8 20 6.8v10.4c0 1-.8 1.8-1.8 1.8H5.8C4.8 19 4 18.2 4 17.2V6.8Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M5 7l7 5 7-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="login-input"
                            value="{{ old('email') }}"
                            placeholder="Introduce tu correo electrónico"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="login-field">
                    <label for="password" class="login-label">Contraseña</label>

                    <div class="login-input-wrap">
                        <span class="login-icon">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M6.8 10h10.4c1 0 1.8.8 1.8 1.8v6.4c0 1-.8 1.8-1.8 1.8H6.8c-1 0-1.8-.8-1.8-1.8v-6.4c0-1 .8-1.8 1.8-1.8Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 14v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="login-input password-field"
                            placeholder="Introduce tu contraseña"
                            required
                        >

                        <button type="button" class="toggle-password" id="togglePassword">
                            Mostrar
                        </button>
                    </div>
                </div>

                <div class="login-actions">
                    <button type="submit" class="login-btn" id="loginButton">
                        <span class="login-btn-text" id="loginButtonText">Entrar al sistema</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');
        const loginButtonText = document.getElementById('loginButtonText');

        if (passwordInput && togglePassword) {
            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';

                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                togglePassword.textContent = isPassword ? 'Ocultar' : 'Mostrar';
            });
        }

        if (loginForm && loginButton && loginButtonText) {
            loginForm.addEventListener('submit', function () {
                loginButton.classList.add('is-loading');
                loginButton.disabled = true;
                loginButtonText.textContent = 'Verificando acceso...';
            });
        }
    });
</script>

@endsection