<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movimiento extends Model
{



public function producto() {
    return $this->belongsTo(Producto::class, 'id_producto');
}

public function usuario() {
    return $this->belongsTo(User::class, 'id_usuario');
}




    use HasFactory;
}
