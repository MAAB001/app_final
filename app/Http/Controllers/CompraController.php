<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function create()
    {
        $proveedores = \App\Models\Proveedor::all();
        $productos    = Producto::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        // Validación inicial
        $request->validate([
            'id_proveedor'   => 'required|exists:proveedores,id_proveedor',
            'comprobante'    => 'required|string',
            'productos_json' => 'required|json',
        ]);

        $productos = json_decode($request->productos_json, true);
        if (!$productos || count($productos) === 0) {
            return back()->with('error', 'Debe agregar al menos un producto.');
        }

        DB::beginTransaction();
        try {
            // 1) Crear cabecera de compra
            $compra = Compra::create([
                'id_proveedor' => $request->id_proveedor,
                'id_usuario'   => auth()->id(),
                'fecha_compra' => now(),
                'comprobante'  => $request->comprobante,
                'total'        => 0,
            ]);

            $total = 0;

            // 2) Crear detalles y actualizar stock
            foreach ($productos as $item) {
                $producto = Producto::findOrFail($item['id_producto']);
                $cantidad = intval($item['cantidad']);
                $precio   = $producto->precio; // asegúrate que sea el campo correcto
                $subtotal = $precio * $cantidad;

                DetalleCompra::create([
                    'id_compra'      => $compra->id_compra,
                    'id_producto'    => $producto->id,
                    'cantidad'       => $cantidad,
                    'precio_unitario'=> $precio,
                    'subtotal'       => $subtotal,
                ]);

                // Incrementar stock
                $producto->increment('stock', $cantidad);

                // Registrar en historial_movimientos
                DB::table('historial_movimientos')->insert([
                    'id_producto'      => $producto->id,
                    'id_usuario'       => auth()->id(),
                    'cantidad'         => $cantidad,
                    'tipo_movimiento'  => 'entrada',
                    'motivo'           => 'Compra #' . $compra->id_compra,
                    'fecha_movimiento' => now(),
                ]);

                $total += $subtotal;
            }

            // 3) Actualizar total en la compra
            $compra->update(['total' => $total]);

            DB::commit();
            return redirect()->route('compras.create')
                             ->with('success', 'Compra registrada con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Loguear el error para depuración
            \Log::error('Error al registrar compra: ' . $e->getMessage());
            return back()->with('error', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }
}
