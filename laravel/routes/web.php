<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\IncidenciaController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/tecnicos', [TecnicoController::class, 'index'])->name('tecnicos.index');
Route::get('/especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
Route::get('/incidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');