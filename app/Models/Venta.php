<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetallesVenta;
use App\Models\User;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = ['id_usuario', 'fecha', 'total'];

    // Relación con el usuario (Una venta pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con detalles_venta (Una venta tiene muchos detalles)
    public function detalles()
    {
        return $this->hasMany(DetallesVenta::class, 'id_venta');
    }
}