# ReparaYa · Producto 3
## Migración del sistema a Laravel

**Asignatura:** FP.448 - (P) Desarrollo back-end con PHP, framework MVC y gestión de contenidos  
**Institución:** UOC  
**Grupo:** BackLord  

### Integrantes
- Erick Coll Rodríguez
- Carles Miguel Millán
- Miguel Alegre Zaragoza

---

## 1. Descripción general

**ReparaYa** es una aplicación de gestión de reparaciones que evoluciona desde el **Producto 2**, desarrollado con una arquitectura **PHP MVC propia**, hacia una nueva base técnica construida sobre **Laravel**.

El objetivo del **Producto 3** no es rehacer el proyecto desde cero, sino **migrar progresivamente la aplicación anterior a Laravel**, manteniendo la lógica de negocio ya existente, reutilizando la base de datos real del sistema y preparando una estructura moderna, estable y escalable para el trabajo en equipo.

En esta fase se ha dejado construida la **base técnica común del proyecto**, permitiendo que el resto del equipo pueda continuar el desarrollo funcional sobre una estructura homogénea y ya validada.

---

## 2. Objetivo del Producto 3

El objetivo principal del Producto 3 es:

- migrar la aplicación ReparaYa a **Laravel**
- consolidar una **base técnica común**
- reutilizar la base de datos real **`reparaya`**
- permitir el trabajo colaborativo mediante una estrategia Git basada en **`main`**, **`develop`** y ramas **feature**
- preparar el proyecto para la migración funcional del núcleo del sistema y la incorporación de nuevas funcionalidades específicas del producto

---

## 3. Estado actual del proyecto

En el momento actual, el proyecto dispone de una **base Laravel operativa y validada**.

### Ya está hecho
- nuevo repositorio independiente para el Producto 3
- estructura base del proyecto preparada
- entorno Docker funcionando correctamente
- Laravel operativo en local
- conexión real con la base de datos **`reparaya`**
- importación y validación de tablas reales del sistema
- modelos Eloquent base:
  - `Usuario`
  - `Tecnico`
  - `Especialidad`
  - `Incidencia`
- relaciones principales entre modelos definidas
- sistema base de autenticación con login funcional
- gestión de sesión operativa
- `HomeController` y vista principal funcional
- layout Blade común
- navegación base preparada
- controladores base para el resto del equipo
- rutas base organizadas
- rama de trabajo individual creada y PR inicial preparada hacia `develop`

### Pendiente de desarrollo posterior
- migración completa del núcleo funcional del Producto 2 a Laravel
- CRUDs completos del sistema
- desarrollo del bloque B2B
- comisiones y liquidaciones
- endpoint API `/api/servicios/zonas`
- integración completa del trabajo del equipo
- validación final conjunta
- adaptación final al servidor UOC si fuese necesario

---

## 4. Arquitectura del proyecto

### Base actual
El proyecto convive actualmente con dos bloques principales:

#### `laravel/`
Base oficial del **Producto 3**.  
Todo el desarrollo nuevo debe construirse aquí.

#### `src/`
Sistema anterior del **Producto 2**, desarrollado en PHP MVC propio.  
Se conserva únicamente como **referencia funcional** para la migración.

### Criterio adoptado
- **Laravel** es la base oficial del Producto 3.
- La carpeta `src/` no debe ampliarse como núcleo del nuevo producto.
- Toda nueva funcionalidad debe crecer sobre la carpeta `laravel/`.

---

## 5. Tecnologías utilizadas

### Backend
- PHP
- Laravel

### Base de datos
- MySQL

### Entorno y herramientas
- Docker
- Docker Compose
- phpMyAdmin
- Git
- GitHub

### Arquitectura
- MVC
- ORM con Eloquent
- sesiones para autenticación base

---

## 6. Estructura del repositorio

```text
ReparaYa-Producto3-Laravel/
│
├── laravel/                     # Base oficial del Producto 3 en Laravel
│   ├── app/
│   │   ├── Http/Controllers/
│   │   └── Models/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   │   └── views/
│   │       ├── auth/
│   │       └── layouts/
│   ├── routes/
│   ├── storage/
│   └── tests/
│
├── src/                         # Sistema legacy del Producto 2 (referencia funcional)
│   ├── app/
│   ├── config/
│   ├── core/
│   └── public/
│
├── bbddReparaYa.sql             # Base de datos real del proyecto
├── docker-compose.yml           # Orquestación del entorno
├── Dockerfile.web               # Configuración del entorno legacy
├── Dockerfile.laravel-web       # Configuración del entorno Laravel
└── README.md
