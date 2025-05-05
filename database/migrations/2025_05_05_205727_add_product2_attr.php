<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos2', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('categoria');
            $table->string('talla')->nullable();
            $table->string('color')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->string('rfid_tag')->nullable();
            $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos2', function (Blueprint $table) {
            $table->dropColumn([
                'nombre',
                'categoria',
                'talla',
                'color',
                'precio',
                'stock',
                'rfid_tag',
                'imagen',
            ]);
        });
    }
};
