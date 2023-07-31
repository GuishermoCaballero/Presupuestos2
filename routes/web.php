<?php

use App\Http\Controllers\CantidadController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoUsuariosController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', [ProyectoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/proyecto/create', [ProyectoController::class, 'create'])->middleware(['auth', 'verified'])->name('proyecto.create');
Route::post('/proyecto/save', [ProyectoController::class, 'save'])->middleware(['auth', 'verified'])->name('proyecto.save');
Route::get('/proyecto/show/{id}', [ProyectoController::class, 'show'])->middleware(['auth', 'verified'])->name('proyecto.show');

//Etiquetas
Route::get('/proyecto/{id}/edit/etiquetas', [EtiquetaController::class, 'edit'])->middleware(['auth', 'verified'])->name('proyecto.etiquetas.edit');
Route::post('/proyecto/{id}/add-etiqueta', [EtiquetaController::class, 'save'])->middleware(['auth', 'verified'])->name('proyecto.add.etiqueta');

//Cantidades
Route::get('/proyecto/{id}/edit/cantidades', [CantidadController::class, 'edit'])->middleware(['auth', 'verified'])->name('proyecto.cantidades.edit');
Route::post('/proyecto/{id}/cantidad', [CantidadController::class, 'save'])->middleware(['auth', 'verified'])->name('proyecto.save.cantidad');

//Cantidades
Route::get('/proyecto/{id}/edit/usuarios', [ProyectoUsuariosController::class, 'index'])->middleware(['auth', 'verified'])->name('proyecto.usuarios.index');
Route::post('/proyecto/{id}/usuarios', [ProyectoUsuariosController::class, 'save'])->middleware(['auth', 'verified'])->name('proyecto.add.usuario');
Route::get('/proyecto/{id}/edit/usuario/{usuario}', [ProyectoUsuariosController::class, 'edit'])->middleware(['auth', 'verified'])->name('proyecto.usuarios.edit');
Route::post('/proyecto/{id}/edit/usuario/{usuario}', [ProyectoUsuariosController::class, 'save_permissions'])->middleware(['auth', 'verified'])->name('proyecto.usuarios.permissions.save');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
