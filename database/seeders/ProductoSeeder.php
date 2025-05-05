<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            [
                'id' => 14,
                'nombre' => 'Predactor X',
                'categoria' => 'Zapatos',
                'talla' => '40',
                'color' => 'Negro',
                'precio' => 19.99,
                'stock' => 10,
                'rfid_tag' => '04:21:39:70:8F:61:80',
                'imagen' => 'camiseta_basica.jpg',
            ],
            [
                'id' => 15,
                'nombre' => 'Pantalón Deportivo',
                'categoria' => 'Ropa',
                'talla' => 'L',
                'color' => 'Negro',
                'precio' => 29.99,
                'stock' => 50,
                'rfid_tag' => 'RFID654321',
                'imagen' => 'pantalon_deportivo.jpg',
            ],
            [
                'id' => 16,
                'nombre' => 'Zapatillas Running',
                'categoria' => 'Calzado',
                'talla' => '42',
                'color' => 'Azul',
                'precio' => 49.99,
                'stock' => 30,
                'rfid_tag' => 'RFID987654',
                'imagen' => 'zapatillas_running.jpg',
            ],
        ]);
    }
}
