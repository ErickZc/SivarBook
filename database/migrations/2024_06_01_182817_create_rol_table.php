<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table){
            $table->increments('id_rol');
            $table->string('nombre_rol');
            $table->boolean('estado', true);

        });

        DB::statement('ALTER TABLE `rol` MODIFY `estado` BIT NOT NULL DEFAULT 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};
