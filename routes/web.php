<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CultivosController;
use App\Http\Controllers\Auth\RegisterMayordomoController;
use App\Http\Controllers\RecolectaController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\SolicitudController;



// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación protegidas por el middleware centralizado
Auth::routes(['middleware' => 'role.redirect']);

// Rutas protegidas por roles
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:trabajador'])->group(function () {
    Route::get('/trabajador', function () {
        return view('trabajador.dashboard');
    })->name('trabajador.dashboard');
});

Route::middleware(['auth', 'role:mayordomo'])->group(function () {
    Route::get('/mayordomo', function () {
        return view('mayordomo.dashboard');
    })->name('mayordomo.dashboard');
});

Route::get('/cultivos/formcultivo', [CultivosController::class, 'create'])->name('cultivos.create');
Route::post('/cultivos/store', [CultivosController::class, 'store'])->name('cultivos.store');
Route::get('/listac', [CultivosController::class, 'index'])->name('cultivos.index');
Route::put('/cultivos/{id}', [CultivosController::class, 'update'])->name('cultivos.update');
Route::delete('/cultivos/{id}', [CultivosController::class, 'destroy'])->name('cultivos.destroy');


Route::get('/register-mayordomo', [RegisterMayordomoController::class, 'showForm'])->name('register.mayordomo.form');
Route::post('/register-mayordomo', [RegisterMayordomoController::class, 'register'])->name('register.mayordomo');

Route::get('/recolectas/create', [RecolectaController::class, 'create'])->name('recolectas.create');
Route::post('/recolectas/store', [RecolectaController::class, 'store'])->name('recolectas.store');

Route::resource('fincas', FincaController::class);

Route::get('/recolectas/graficas', [RecolectaController::class, 'graficas'])->name('recolectas.graficas');

Route::get('/recolectas/rentabilidad', [RecolectaController::class, 'rentabilidad'])->name('recolectas.rentabilidad');

Route::get('/insumos/create', [InsumoController::class, 'create'])->name('insumos.create');
Route::post('/insumos', [InsumoController::class, 'store'])->name('insumos.store');
Route::get('/insumos', [InsumoController::class, 'index'])->name('insumos.index');
Route::put('/insumos/{id}', [InsumoController::class, 'update'])->name('insumos.update');
Route::delete('/insumos/{id}', [InsumoController::class, 'destroy'])->name('insumos.destroy');

Route::get('herramientas', [HerramientaController::class, 'index'])->name('herramientas.index');
Route::get('herramientas/create', [HerramientaController::class, 'create'])->name('herramientas.create');
Route::post('herramientas', [HerramientaController::class, 'store'])->name('herramientas.store');
Route::put('/herramientas/{id}', [HerramientaController::class, 'update'])->name('herramientas.update');
Route::delete('/herramientas/{id}', [HerramientaController::class, 'destroy'])->name('herramientas.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::get('/solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/solicitudes/{id}/edit', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
    Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
    Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');
    Route::get('solicitudes/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');

});