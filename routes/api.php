<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas de tu API. Se cargan con el grupo "api" 
| para manejar peticiones y devolver datos en formato JSON.
|
*/

// Ruta protegida con Sanctum (para autenticación de usuarios)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para obtener un producto por NFC (usada por NFC Tools)
Route::get('/producto/{id_producto}', [ProductoController::class, 'buscarPorNFC']);

// Ruta para registrar el último producto escaneado (opcional)
Route::post('/notificar-escaneo', [ProductoController::class, 'notificarEscaneo']);