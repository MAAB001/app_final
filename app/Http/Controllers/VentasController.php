<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\DetalleMovimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentasController extends Controller
{
    // Mostrar el formulario de ventas
    public function create()
    {
        $productos = DB::table('productos')->get();
        return view('ventas', compact('productos'));
    }

    // Guardar la venta y sus detalles en la base de datos
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validación
            $request->validate([
                'productos' => 'required|array',
                'cantidad' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
            ]);

            // Verificar si hay stock suficiente
            foreach ($request->productos as $productoId) {
                $producto = Producto::findOrFail($productoId);
                if ($producto->stock < $request->cantidad) {
                    return redirect()->back()->with('error', 'No hay suficiente stock para uno o más productos.');
                }
            }

            // Crear la venta
            $venta = Venta::create([
                'id_usuario' => Auth::id(),
                'fecha' => now(),
                'total' => $request->total,
            ]);

            // Guardar detalles, actualizar stock y registrar movimiento
            foreach ($request->productos as $productoId) {
                $producto = Producto::findOrFail($productoId);
                $cantidad = $request->cantidad;
                $subtotal = $producto->precio * $cantidad;

                // Crear detalle de venta
                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'id_producto' => $producto->id,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ]);

                // Actualizar stock
                DB::table('productos')
                    ->where('id', $producto->id)
                    ->decrement('stock', $cantidad);

                // Registrar movimiento de salida
                DetalleMovimiento::create([
                    'id_producto' => $producto->id,
                    'id_usuario' => Auth::id(),
                    'cantidad' => $cantidad,
                    'tipo_movimiento' => 'salida',
                    'motivo' => 'Venta #' . $venta->id_venta,
                    'fecha_movimiento' => Carbon::now(),
                ]);
            }

            DB::commit();
            return redirect()->route('ventas.create')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }
}

    