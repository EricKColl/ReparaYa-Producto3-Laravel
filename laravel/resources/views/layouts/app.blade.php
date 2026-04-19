<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReparaYa Producto 3')</title>
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
            margin: 0;
            font-size: 28px;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
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