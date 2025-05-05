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
        return view('productos.index', compact('productos'));
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
        $producto = Producto::where('id', $id_producto)->first(); // Usando 'id_producto'


        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        
        if (!Producto2::where('id', $producto->id)->exists()) {
            $producto2 = new Producto2();
            $producto2->id = $producto->id;
            $producto2->nombre = $producto->nombre;
            $producto2->categoria = $producto->categoria;
            $producto2->talla = $producto->talla;
            $producto2->color = $producto->color;
            $producto2->precio = $producto->precio;
            $producto2->stock = $producto->stock;
            $producto2->rfid_tag = $producto->rfid_tag;
            $producto2->imagen = $producto->imagen;
            $producto2->save(); // Guardar el producto en la tabla productos2
            // Actualizar el stock del producto original
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