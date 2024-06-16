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
        Schema::create('lugares_valoraciones', function (Blueprint $table){
            $table->increments('id_lValoracion');
            $table->text('descripcion');
            $table->dateTime('fecha');

            $table->unsignedInteger('id_lugar');
            $table->foreign('id_lugar')->references('id_lugar')->on('lugares');
            $table->unsignedInteger('id_valoracion');
            $table->foreign('id_valoracion')->references('id_valoracion')->on('valoraciones');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugares_valoraciones');
    }
};
