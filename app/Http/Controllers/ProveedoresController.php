<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedoresController extends Controller
{
    // Método para mostrar la vista de proveedores
    public function create()
    {
        return view('productos.proveedores');
    }

    // Método para guardar un nuevo proveedor
    public function store(Request $request)
    {
        // Validar que el nombre del proveedor sea único
        $request->validate([
            'nombre' => 'required|string|max:255|unique:proveedores,nombre',
            'contacto' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear el proveedor con los datos validados
        $proveedor = Proveedor::create([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'direccion' => $request->direccion,
        ]);

        // Devolver una respuesta JSON con los datos del proveedor y un mensaje de éxito
             return redirect()->route('proveedores.create')->with('mensaje', 'Proveedor registrado correctamente.');
    }
}

