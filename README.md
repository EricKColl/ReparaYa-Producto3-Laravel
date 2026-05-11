# ReparaYa · Producto 3

## Migración a Laravel, bloque B2B, API REST y despliegue en servidor UOC

**Asignatura:** FP.448 - Desarrollo back-end con PHP, framework MVC y gestión de contenidos  
**Institución:** Universitat Oberta de Catalunya  
**Producto:** Producto 3  
**Proyecto:** ReparaYa  
**Repositorio:** ReparaYa-Producto3-Laravel  
**Rama principal de integración:** `Develop`  
**Rama estable de entrega:** `main`

---

## 1. Descripción general

Este repositorio contiene el desarrollo del **Producto 3 de ReparaYa**, una evolución de la aplicación desarrollada en el Producto 2 hacia un entorno basado en **Laravel**.

El objetivo principal de esta entrega ha sido migrar la aplicación a un framework PHP moderno, aplicar una arquitectura MVC más robusta, mejorar la estructura del proyecto, incorporar nuevas funcionalidades B2B para administradores de fincas, crear un servicio REST en formato JSON y publicar la aplicación en el servidor proporcionado por la UOC.

La aplicación permite gestionar usuarios, técnicos, especialidades, incidencias, gestoras, comunidades de propietarios, avisos B2B, liquidaciones mensuales y datos agregados por zona mediante una API REST.

---

## 2. URL pública de despliegue

La aplicación se ha desplegado en el servidor UOC y responde bajo el subdirectorio requerido por el enunciado:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3
```

Endpoint REST del Producto 3:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3/api/servicios/zonas
```

---

## 3. Tecnologías utilizadas

- PHP 8.3 / 8.4
- Laravel 12
- Blade
- Eloquent ORM
- MySQL 8
- Docker
- Docker Compose
- phpMyAdmin
- Git
- GitHub
- Servidor UOC mediante SSH/SFTP
- Apache / hosting UOC
- WSL 2 para optimización del entorno local en Windows

---

## 4. Estructura principal del repositorio

```text
ReparaYa-Producto3-Laravel/
├── laravel/                  # Aplicación principal Laravel del Producto 3
├── src/                      # Aplicación legacy del Producto 2 como referencia funcional
├── bbddReparaYa.sql          # Dump de base de datos utilizado para reconstruir el proyecto
├── docker-compose.yml        # Definición de servicios Docker
├── Dockerfile.laravel-web    # Imagen del contenedor Laravel
├── Dockerfile.web            # Imagen del contenedor legacy PHP
└── README.md                 # Documentación principal del repositorio
```

La carpeta más importante para el Producto 3 es:

```text
laravel/
```

Dentro de ella se encuentran los controladores, modelos, vistas Blade, rutas y configuración Laravel.

---

## 5. Estructura interna de Laravel

```text
laravel/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/views/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── composer.json
├── composer.lock
└── artisan
```

Archivos especialmente relevantes:

```text
laravel/routes/web.php
laravel/routes/api.php
laravel/app/Http/Controllers/B2BController.php
laravel/app/Http/Controllers/ApiController.php
laravel/app/Http/Controllers/GestoraController.php
laravel/app/Http/Controllers/ComunidadController.php
laravel/app/Http/Controllers/IncidenciaController.php
laravel/resources/views/layouts/app.blade.php
laravel/resources/views/components/reparaya-calendar.blade.php
```

---

## 6. Funcionalidades implementadas

### 6.1. Migración a Laravel

Se ha migrado la base funcional del Producto 2 a una estructura Laravel basada en:

- Rutas Laravel.
- Controladores.
- Modelos Eloquent.
- Vistas Blade.
- Layout común.
- Gestión de sesión.
- Validaciones.
- Separación MVC.

### 6.2. Módulos CRUD principales

La aplicación incluye gestión de:

- Usuarios.
- Técnicos.
- Especialidades.
- Incidencias.
- Gestoras.
- Comunidades.

Cada módulo utiliza controladores Laravel, modelos Eloquent y vistas Blade específicas para listar, crear, editar y eliminar registros cuando corresponde.

### 6.3. Bloque B2B para gestoras

El Producto 3 incorpora un bloque B2B orientado a empresas administradoras de fincas.

Funcionalidades principales:

- Alta y gestión de gestoras por parte del administrador.
- Alta y gestión de comunidades de propietarios.
- Login propio para gestoras.
- Panel profesional de gestora.
- Creación de avisos B2B asociados a comunidades.
- Edición y eliminación de avisos por parte de la gestora.
- Selección de fecha y hora del servicio.
- Teléfono de contacto cargado desde la comunidad.
- Estado del aviso: pendiente, finalizado o cancelado.
- Cálculo automático de comisiones.
- Liquidaciones mensuales para el administrador.

### 6.4. Comisiones y liquidaciones

Cada gestora tiene un porcentaje de comisión pactado. El sistema calcula automáticamente la comisión aplicando:

```text
Comisión = precio_base × porcentaje_gestora / 100
```

Solo se liquidan los servicios en estado:

```text
Finalizada
```

El administrador puede consultar el resumen mensual de importes y comisiones desde:

```text
/liquidaciones
```

### 6.5. API REST

Se ha implementado el endpoint requerido por el enunciado:

```text
/api/servicios/zonas
```

Este endpoint devuelve un JSON con los servicios agrupados por zona:

```json
{
    "total_global": 1,
    "zonas": [
        {
            "zona": "Norte",
            "total_servicios": 1,
            "porcentaje": 100
        }
    ]
}
```

La API calcula:

- Nombre de la zona.
- Número total de servicios realizados en esa zona.
- Porcentaje respecto al total global.

### 6.6. Calendarios operativos por rol

Se ha creado un componente reutilizable de calendario:

```text
laravel/resources/views/components/reparaya-calendar.blade.php
```

Calendarios integrados:

- Administrador: calendario global de servicios.
- Cliente: calendario de sus incidencias.
- Técnico: calendario de servicios asignados.
- Gestora: calendario de avisos gestionados.

### 6.7. Mejoras visuales y de experiencia

Se ha rediseñado la interfaz para conseguir una experiencia más profesional y coherente:

- Login más compacto y centrado.
- Barra de navegación contextual por rol.
- Logo de ReparaYa como acceso al inicio.
- Paneles profesionales para gestoras, comunidades y liquidaciones.
- Tablas más claras y estructuradas.
- Indicadores visuales y métricas operativas.
- Diseño tecnológico, limpio y formal.

---

## 7. Base de datos

La base de datos utilizada en local se llama:

```text
reparaya
```

El archivo de base de datos incluido en el repositorio es:

```text
bbddReparaYa.sql
```

Este archivo contiene la estructura y datos necesarios para reconstruir la base de datos del proyecto, incluyendo:

- usuarios
- tecnicos
- especialidades
- incidencias
- gestoras
- comunidades
- campos B2B
- tablas auxiliares de Laravel

En el servidor UOC la base de datos disponible es:

```text
wordpress3
```

Para el despliegue se importó el contenido de `bbddReparaYa.sql` dentro de dicha base de datos, sin eliminar las tablas propias de WordPress.

---

## 8. Ejecución local con Docker

### 8.1. Levantar el entorno

Desde la raíz del repositorio:

```bash
docker compose up -d --build
```

### 8.2. Comprobar servicios

```bash
docker compose ps
```

Servicios principales:

```text
daw-laravel-web     Aplicación Laravel
daw-db              Base de datos MySQL
daw-phpmyadmin      Administración visual de MySQL
```

### 8.3. Accesos locales

Aplicación Laravel:

```text
http://localhost:8000
```

phpMyAdmin:

```text
http://localhost:8081
```

API REST local:

```text
http://localhost:8000/api/servicios/zonas
```

---

## 9. Configuración local de Laravel

El archivo `.env` no debe subirse al repositorio.

Configuración local orientativa:

```env
APP_NAME=ReparaYa
APP_ENV=local
APP_KEY=base64:arPaEtxfI6qVZ9QWRObiwRrJAC6TKJmhiifGubm2T4o=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=reparaya
DB_USERNAME=root
DB_PASSWORD=rootpass

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Después de modificar `.env`:

```bash
docker exec -it daw-laravel-web sh -c "cd /app && php artisan optimize:clear"
```

---

## 10. Instalación de dependencias

Si falta la carpeta `vendor`, instalar dependencias dentro del entorno Laravel.

En local, según el entorno disponible:

```bash
docker exec -it daw-laravel-web sh -c "cd /app && composer install"
```

En el servidor UOC se utilizó Composer propio del usuario:

```bash
/home/uocx3/composer install --no-dev --optimize-autoloader
```

Durante el despliegue se ajustó `composer.json` y `composer.lock` para compatibilidad con PHP 8.3.6 del servidor UOC.

---

## 11. Despliegue en servidor UOC

La aplicación se desplegó en el servidor:

```text
fp064.techlab.uoc.edu
```

Estructura utilizada:

```text
/home/uocx3/producto3_app
/home/uocx3/public_html/producto3 -> /home/uocx3/producto3_app/public
```

La carpeta completa de Laravel se encuentra fuera de la ruta pública directa, y solo se expone la carpeta `public`.

URL final:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3
```

API final:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3/api/servicios/zonas
```

---

## 12. Comprobaciones realizadas

### 12.1. Comprobación de rutas

```bash
php artisan route:list
```

Ruta API validada:

```text
GET|HEAD api/servicios/zonas
```

### 12.2. Comprobación de API

```bash
curl -s http://localhost:8000/api/servicios/zonas | python3 -m json.tool
```

### 12.3. Comprobación de vistas Blade

```bash
php artisan view:cache
```

Resultado esperado:

```text
Blade templates cached successfully.
```

### 12.4. Comprobación de base de datos

```bash
php artisan tinker --execute="echo DB::table('usuarios')->count();"
```

En servidor UOC se comprobó que Laravel conectaba correctamente con la base de datos importada.

---

## 13. Flujo Git y GitHub

Se ha trabajado con una estrategia basada en ramas:

```text
main      Rama estable
Develop   Rama de integración
feature   Ramas individuales de desarrollo
```

Ramas destacadas:

- Erick---feature/frontend-profesional
- Erick---feature/ajustes-integracion-b2b
- Erick---feature/despliegue-uoc-producto3
- Erick---feature/composer-compatible-uoc
- Miguel-Alegre---feature/b2b-api
- Carles-Miguel---feature/crud-core

Se han utilizado Pull Requests para integrar cambios en `Develop` y posteriormente en `main`.

---

## 14. Optimización del entorno local

Durante el desarrollo se detectó lentitud al ejecutar Laravel desde una carpeta de Windows montada en Docker Desktop.

Solución aplicada:

Mover el proyecto al filesystem Linux de WSL 2:

```text
~/proyectos/ReparaYa-Producto3-Laravel
```

Resultado:

```text
Antes: rutas cargando en varios segundos.
Después: rutas cargando en milisegundos.
```

Esta optimización no modifica la lógica de negocio, pero mejora significativamente el rendimiento durante el desarrollo.

---

## 15. Archivos que no deben subirse al repositorio

No deben subirse:

```text
.env
vendor/
node_modules/
.git/
storage/logs/*
storage/framework/cache/*
storage/framework/views/*
storage/framework/sessions/*
```

El repositorio debe contener código fuente, estructura, documentación y base de datos, pero no credenciales privadas ni dependencias generadas.

---

## 16. Estado final del producto

El Producto 3 queda en estado funcional, documentado y desplegado.

Funcionalidades validadas:

- Home pública.
- Login de usuarios.
- Login de gestoras.
- Gestión de usuarios.
- Gestión de técnicos.
- Gestión de especialidades.
- Gestión de incidencias.
- Gestión de gestoras.
- Gestión de comunidades.
- Panel B2B de gestoras.
- Creación, edición y eliminación de avisos B2B.
- Liquidaciones mensuales.
- Calendarios por rol.
- API REST por zonas.
- Despliegue bajo `/producto3` en servidor UOC.

---

## 17. Nota para el consultor

Para revisar el proyecto desplegado:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3
```

Para revisar el endpoint REST:

```text
https://fp064.techlab.uoc.edu/~uocx3/producto3/api/servicios/zonas
```

Estructura del servidor:

```text
/home/uocx3/producto3_app
/home/uocx3/public_html/producto3
```

La carpeta `public_html/producto3` es un enlace simbólico hacia:

```text
/home/uocx3/producto3_app/public
```

Esto permite que Laravel quede protegido y que solo se exponga públicamente la carpeta `public`.

---

## 18. Equipo

Proyecto realizado por el equipo ReparaYa para el Producto 3 de la UOC.

Integrantes:

- Erick Coll Rodríguez
- Carles Miguel Millán
- Miguel Alegre Zaragoza
