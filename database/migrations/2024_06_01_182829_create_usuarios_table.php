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
        Schema::create('usuarios', function (Blueprint $table){
            $table->increments('id_usuario');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->string('correo');
            $table->string('password');
            $table->boolean('estado', true);
            $table->binary('imagen');
            $table->dateTime('fechaCreacion');

            $table->unsignedInteger('id_rol');
            $table->foreign('id_rol')->references('id_rol')->on('rol');

        });

        DB::statement('ALTER TABLE usuarios MODIFY imagen LONGBLOB');
        DB::statement('ALTER TABLE `usuarios` MODIFY `estado` BIT NOT NULL DEFAULT 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
