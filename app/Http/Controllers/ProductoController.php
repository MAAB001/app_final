<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Producto2;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto2::all();
        return view('productos.index', ['productos' => $productos]);
    }

    public function vender($id)
    {
        $producto = Producto::findOrFail($id);
        if ($producto->stock > 0) {
            $producto->stock -= 1;
            $producto->save();
            return redirect()->route('productos.index')->with('success', 'Producto vendido correctamente.');
        }

        return redirect()->route('productos.index')->with('error', 'No hay stock suficiente.');
    }

    public function editar(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Buscar un producto por su ID
    public function buscarPorNFC($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->first(); // Usando 'id_producto'
        $productos2 = new Producto2; 

        $productos2-> id_producto = $producto-> id_producto;
        $productos2-> nombre = $producto->nombre;
        $productos2-> categoria = $producto-> categoria;
        $productos2-> talla = $producto-> talla;
        $productos2-> color = $producto-> color;
        $productos2-> precio = $producto-> precio;
        $productos2-> stock = $producto-> stock;
        
        $productos2-> save();


        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Registrar el producto escaneado en sesión
        session(['ultimo_escaneo' => $producto]);



        return response()->json([
            'nombre' => $producto->nombre,
            'categoria' => $producto->categoria,
            'talla' => $producto->talla,
            'color' => $producto->color,
            'precio' => $producto->precio,
            'stock' => $producto->stock,
        ]);
    }

    // Obtener el último producto escaneado
    public function obtenerUltimoEscaneo()
    {
        
        $producto = Producto2 ::all(); // Leer la sesión
        return response()->json(['producto' => $producto]);
    }
}