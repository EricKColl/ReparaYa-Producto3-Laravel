@extends('layouts.app')

@section('title', 'Inicio · ReparaYa')

@section('content')
    <h2>ReparaYa Producto 3</h2>
    <p>Base Laravel funcionando correctamente.</p>
    <p>La estructura inicial del proyecto ya está operativa y preparada para continuar con la migración del sistema.</p>

    @if($usuario)
        <hr style="margin: 25px 0;">

        <h3>Sesión iniciada</h3>
        <p><strong>ID:</strong> {{ $usuario['id'] }}</p>
        <p><strong>Nombre:</strong> {{ $usuario['nombre'] }}</p>
        <p><strong>Rol:</strong> {{ $usuario['rol'] }}</p>

        <a href="/logout" style="display:inline-block; margin-top:10px; background:#dc3545; color:white; text-decoration:none; padding:10px 16px; border-radius:6px;">
            Cerrar sesión
        </a>
    @else
        <hr style="margin: 25px 0;">

        <p>No hay ninguna sesión iniciada.</p>

        <a href="/login" style="display:inline-block; margin-top:10px; background:#0d6efd; color:white; text-decoration:none; padding:10px 16px; border-radius:6px;">
            Ir al login
        </a>
    @endif
@endsection