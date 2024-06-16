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
        Schema::create('lugares', function (Blueprint $table){
            $table->increments('id_lugar');
            $table->string('nombre_lugar');
            $table->text('descripcion');
            $table->decimal('precio', 5, 2);
            $table->boolean('estado', true);
            $table->binary('imagen');
            $table->dateTime('fechaPublicacion');

            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->unsignedInteger('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            $table->unsignedInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
        });

        DB::statement('ALTER TABLE lugares MODIFY imagen LONGBLOB');
        DB::statement('ALTER TABLE `lugares` MODIFY `estado` BIT NOT NULL DEFAULT 1');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugares');
    }
};
