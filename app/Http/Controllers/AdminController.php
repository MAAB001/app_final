<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class AdminController extends Controller
{
    public function movimientos()
    {
        return view('movimientos.index');
    }

    public function productos()
    {
        $productos = Producto::with('proveedor')->get(); // Igual que en el de empleado
        return view('productos.index', compact('productos'));
    }

    public function ingresarProducto()
    {
        return view('productos.ingresar_producto');
    }

    public function proveedores()
    {
        return view('productos.proveedores');
    }
}
    