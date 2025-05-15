<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class EmpleadoController extends Controller
{
    public function productos()
    {
        $productos = Producto::with('proveedor')->get(); // Traer productos con proveedor
        return view('productos.index', compact('productos'));
    }

    public function ventas()
    {
        return view('ventas');
    }
}
