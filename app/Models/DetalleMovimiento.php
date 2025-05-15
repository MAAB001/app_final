<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleMovimiento;


class DetalleMovimiento extends Model
{
    protected $table = 'historial_movimientos'; // Nombre real de la tabla
    public $timestamps = false; // Si no tienes columnas created_at y updated_at

    protected $fillable = [
        'id_producto',
        'id_usuario',
        'cantidad',
        'tipo_movimiento',
        'motivo',
        'fecha_movimiento'
    ];

    // Relación con productos
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Relación con usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
