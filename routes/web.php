<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ProductoController,
    VentasController,
    ProveedoresController,
    CompraController,
    MovimientoController,
    AdminController,
    EmpleadoController
};

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo general autenticado
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =================== ADMIN =====================
    Route::middleware('role:admin')->group(function () {
        // Módulo de movimientos
        Route::get('/admin/movimientos', [AdminController::class, 'movimientos'])->name('admin.movimientos');

        // Productos
        Route::get('/admin/productos', [AdminController::class, 'productos'])->name('admin.productos');
        Route::get('/admin/productos/ingresar', [AdminController::class, 'ingresarProducto'])->name('admin.productos.ingresar');
        Route::get('/admin/productos/proveedores', [AdminController::class, 'proveedores'])->name('admin.productos.proveedores');

        // Compras
        Route::get('/compras', [CompraController::class, 'create'])->name('compras.create');
        Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');

        // Movimiento general (vista global)
        Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
    });

    // ================= EMPLEADO ====================
    Route::middleware('role:empleado')->group(function () {
        Route::get('/empleado/productos', [EmpleadoController::class, 'productos'])->name('empleado.productos');
        Route::get('/empleado/ventas', [EmpleadoController::class, 'ventas'])->name('empleado.ventas');
    });

    // ================= COMPARTIDO ==================
    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::post('/productos/vender/{id}', [ProductoController::class, 'vender'])->name('productos.vender');
    Route::post('/productos/editar/{id}', [ProductoController::class, 'editar'])->name('productos.editar');
    Route::get('/ingresar-producto', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/ingresar-producto', [ProductoController::class, 'store'])->name('productos.store');

    // RFID
    Route::get('/obtener-ultimo-escaneo', [ProductoController::class, 'obtenerUltimoEscaneo']);

    // Ventas
    Route::get('/ventas', [VentasController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');

    // Proveedores
    Route::get('/proveedores', [ProveedoresController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');
});

// Rutas de autenticación generadas por Laravel Breeze
require __DIR__ . '/auth.php';
