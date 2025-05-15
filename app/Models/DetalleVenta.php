<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Venta;

class DetalleVenta extends Model // ✅ correcto

{
    use HasFactory;

    protected $table = 'detalles_venta';
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'subtotal'];

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
