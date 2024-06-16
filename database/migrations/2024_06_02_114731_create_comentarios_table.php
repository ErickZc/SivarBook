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
        Schema::create('comentarios', function (Blueprint $table){
            $table->increments('id_comentario');
            $table->text('comentario');
            $table->dateTime('fecha');
            $table->string('revision');
            $table->boolean('estado', true);

            $table->unsignedInteger('id_lugar');
            $table->foreign('id_lugar')->references('id_lugar')->on('lugares');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
        });

        DB::statement('ALTER TABLE `comentarios` MODIFY `estado` BIT NOT NULL DEFAULT 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
