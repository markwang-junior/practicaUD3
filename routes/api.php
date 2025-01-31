<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controladores importados
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\PerfilAlumnoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
| 
|
*/

// Rutas para Profesor
Route::get('/profesores', [ProfesorController::class, 'index']);
Route::get('/profesores/{id}', [ProfesorController::class, 'show']);
Route::post('/profesores', [ProfesorController::class, 'store']);
Route::put('/profesores/{id}', [ProfesorController::class, 'update']);
Route::delete('/profesores/{id}', [ProfesorController::class, 'destroy']);

// Rutas para Alumno
Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::get('/alumnos/{id}', [AlumnoController::class, 'show']);
Route::post('/alumnos', [AlumnoController::class, 'store']);
Route::put('/alumnos/{id}', [AlumnoController::class, 'update']);
Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy']);

// Rutas para Asignatura
Route::get('/asignaturas', [AsignaturaController::class, 'index']);
Route::get('/asignaturas/{id}', [AsignaturaController::class, 'show']);
Route::post('/asignaturas', [AsignaturaController::class, 'store']);
Route::put('/asignaturas/{id}', [AsignaturaController::class, 'update']);
Route::delete('/asignaturas/{id}', [AsignaturaController::class, 'destroy']);

Route::prefix('/perfil-alumno')->group(function () {
    Route::get('/{id}', [PerfilAlumnoController::class, 'show']); // Obtener un perfil
    Route::post('/{id}', [PerfilAlumnoController::class, 'store']); // Crear un perfil
    Route::put('/{id}', [PerfilAlumnoController::class, 'update']); // Actualizar un perfil
    Route::delete('/{id}', [PerfilAlumnoController::class, 'destroy']); // Eliminar un perfil
});