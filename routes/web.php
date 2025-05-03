<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas de tu aplicación. Estas rutas son 
| cargadas por el RouteServiceProvider y todas estarán asignadas al 
| grupo de middleware "web".
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos/vender/{id}', [ProductoController::class, 'vender'])->name('productos.vender');
    Route::post('/productos/editar/{id}', [ProductoController::class, 'editar'])->name('productos.editar');

   
    Route::get('/obtener-ultimo-escaneo', [ProductoController::class, 'obtenerUltimoEscaneo']);
});

require __DIR__.'/auth.php';