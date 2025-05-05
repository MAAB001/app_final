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
        // Nothing to do here, as the users table is created by default in Laravel
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // The same thing here, nothing to do as the users table is created by default in Laravel
    }
};
