<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReparaYa')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #222;
        }

        header {
            background: #0d6efd;
            color: white;
            padding: 20px;
        }

        header h1 {
            margin: 0 0 10px 0;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .user-info {
            margin-left: auto;
            font-size: 14px;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <h1>ReparaYa</h1>

    <nav>
        <a href="/">Inicio</a>
        <a href="/usuarios">Usuarios</a>
        <a href="/tecnicos">Técnicos</a>
        <a href="/especialidades">Especialidades</a>
        <a href="/incidencias">Incidencias</a>

        @if(session()->has('usuario_id'))
            <span class="user-info">
                {{ session('usuario_nombre') }} ({{ session('usuario_rol') }})
                <a href="/logout" class="logout-btn">Salir</a>
            </span>
        @else
            <a href="/login">Login</a>
        @endif
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    Producto 3 · Migración a Laravel
</footer>

</body>
</html>