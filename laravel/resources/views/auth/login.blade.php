@extends('layouts.app')

@section('title', 'Login · ReparaYa')

@section('content')
    <h2>Iniciar sesión</h2>

    @if(session('error'))
        <div style="color: red; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="email" style="display:block; margin-bottom: 5px;">Correo electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"
                required
            >
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password" style="display:block; margin-bottom: 5px;">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"
                required
            >
        </div>

        <button
            type="submit"
            style="background: #0d6efd; color: white; border: none; padding: 10px 18px; border-radius: 6px; cursor: pointer;"
        >
            Entrar
        </button>
    </form>
@endsection