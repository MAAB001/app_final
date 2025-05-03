<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        // No cargamos los productos directamente para la vista.
        return view('productos.index');
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

    // Buscar un producto por RFID
    public function buscarPorNFC($rfid)
    {
        $producto = Producto::where('rfid_tag', $rfid)->first();

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
        $producto = session('ultimo_escaneo', null); // Leer la sesión
        return response()->json(['producto' => $producto]);
    }
}