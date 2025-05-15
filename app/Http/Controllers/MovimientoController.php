<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleMovimiento;


class MovimientoController extends Controller
{
    public function index()
    {
        $movimientos = DetalleMovimiento::with('producto', 'usuario')
            ->orderBy('fecha_movimiento', 'desc')
            ->get();

        return view('movimientos.index', compact('movimientos'));
    }
}

