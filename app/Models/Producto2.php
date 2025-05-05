<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto2 extends Model

{

    protected $table = 'productos2';
    
    use HasFactory;
    protected $fillable = [ 'id','nombre', 'categoria', 'talla', 'color','precio','stock'];
    public $timestamps = false;
}
