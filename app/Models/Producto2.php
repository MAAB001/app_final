<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto2 extends Model

{
public function proveedor()
{
    return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
}


    protected $table = 'productos2';
    
    use HasFactory;
    protected $fillable = [ 'id','nombre', 'categoria', 'talla', 'color','precio','iva','precio_total','stock','rfid_tag','id_proveedor'];
    public $timestamps = false;
    
    public $incrementing = false;

}
