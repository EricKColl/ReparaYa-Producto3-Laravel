# ReparaYa - Producto 2

Aplicación web de gestión de reparaciones desarrollada en PHP sin frameworks, siguiendo una arquitectura MVC básica, con base de datos MySQL y entorno Docker.

## Tecnologías utilizadas

- PHP 8.4
- Apache
- MySQL 8
- phpMyAdmin
- Docker / Docker Compose
- HTML5

## Estructura inicial del proyecto

- `src/app/controllers` Controladores
- `src/app/models` Modelos
- `src/app/views` Vistas
- `src/config` Configuración
- `src/core` Núcleo común
- `src/public` Punto de entrada público

## Base de datos

La base de datos utilizada es `reparaya`, importada desde el archivo `bbddReparaYa.sql`.

## Ejecución en local

```bash
docker compose up -d --build
```

Aplicación:
- `http://localhost:8080/public`

phpMyAdmin:
- `http://localhost:8081`

## Estado actual

Base inicial del proyecto preparada:

- entorno Docker operativo
- conexión PDO centralizada
- estructura MVC inicial
- layout común
- ruta principal funcional
- página 404 personalizada