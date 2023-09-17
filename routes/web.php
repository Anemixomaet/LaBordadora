<?php

use App\Http\Livewire\Asistencias;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Personas;
use App\Http\Livewire\Tareas;
use App\Http\Livewire\Clientes;
use App\Http\Livewire\Programaciones;
use App\Http\Livewire\Calendario;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Jugadores;
use App\Http\Livewire\Pagos;
use App\Http\Livewire\Temporadas;
use App\Http\Livewire\Inscripciones;
use App\Http\Livewire\Usuarios;
use App\Http\Livewire\ReporteJugadoresCategoria;
use App\Http\Livewire\ReporteJugadoresAsistencia;
use App\Http\Livewire\ReporteJugadoresPago;
use App\Http\Livewire\Notificaciones;
use App\Models\Asistencia;
use App\Models\Pago;
use App\Models\Temporada;

use Illuminate\Support\Facades\Storage;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::get('/usuarios',Usuarios::class)->name('usuarios');
//     Route::get('/jugadores',Jugadores::class)->name('jugadores');
//     Route::get('/categorias',Categorias::class)->name('categorias');
//     Route::get('/asistencias',Asistencias::class)->name('asistencias');
//     Route::get('/pagos',Pagos::class)->name('pagos');
//     Route::get('/temporadas',Temporadas::class)->name('temporadas');
//     Route::get('/inscripciones',Inscripciones::class)->name('inscripciones');
//     Route::get('/reportes_jugadores_categorias',ReporteJugadoresCategoria::class)->name('jugadores_categoria');
//     Route::get('/reportes_jugadores_asistencia',ReporteJugadoresAsistencia::class)->name('jugadores_asistencia');
//     Route::get('/reportes_jugadores_pago',ReporteJugadoresPago::class)->name('jugadores_pago');
//     Route::get('/notificaciones',Notificaciones::class)->name('notificaciones');
//     Route::get('/jugadores_categorias-pdf',ReporteJugadoresCategoria::class, 'generarPDF');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/usuarios', Usuarios::class)->name('usuarios');
    Route::get('/jugadores', Jugadores::class)->name('jugadores');
    Route::get('/categorias', Categorias::class)->name('categorias');
    Route::get('/asistencias', Asistencias::class)->name('asistencias');
    Route::get('/pagos', Pagos::class)->name('pagos');
    Route::get('/temporadas', Temporadas::class)->name('temporadas');
    Route::get('/inscripciones', Inscripciones::class)->name('inscripciones');
    Route::get('/reportes_jugadores_categorias', ReporteJugadoresCategoria::class)->name('jugadores_categoria');
    Route::get('/reportes_jugadores_asistencia', ReporteJugadoresAsistencia::class)->name('jugadores_asistencia');
    Route::get('/reportes_jugadores_pago', ReporteJugadoresPago::class)->name('jugadores_pago');
    Route::get('/notificaciones', Notificaciones::class)->name('notificaciones');
    Route::get('/jugadores_categorias-pdf', [ReporteJugadoresCategoria::class, 'generarPDF'])->name('jugadores_categorias_pdf');
});
