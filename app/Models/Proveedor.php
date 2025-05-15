<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    // 👇 AÑADE ESTA LÍNEA
    protected $primaryKey = 'id_proveedor';

    // 👇 OPCIONAL: si tu tabla no tiene columnas created_at y updated_at
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'contacto',
        'direccion',
        'email',
        'telefono',
        'razon_social',
        'ruc',
    ];

    // Relación: Un proveedor tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }
}

