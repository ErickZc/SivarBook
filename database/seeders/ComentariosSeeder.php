<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comentarios;

class ComentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comentario = new Comentarios();
        $comentario->id_lugar = 1;
        $comentario->id_usuario = 2;
        $comentario->comentario = 'La comida es super deliciosa, recomendado';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 2;
        $comentario->id_usuario = 5;
        $comentario->comentario = 'Hace mucho frio, les recomiendo llevar sueter :(';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 3;
        $comentario->id_usuario = 5;
        $comentario->comentario = 'Es muy agradable para acampar, tambien hay hoteles desde 20$ por persona';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 3;
        $comentario->id_usuario = 6;
        $comentario->comentario = 'Lleven sueter porque hace demasiado frio, el lugar es muy recomendado';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 5;
        $comentario->id_usuario = 6;
        $comentario->comentario = 'Excelente!';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 5;
        $comentario->id_usuario = 2;
        $comentario->comentario = 'El lugar es muy bueno para pasar en familia, desde 40$ pueden alquilar una habitacion para dos personas :)';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 7;
        $comentario->id_usuario = 2;
        $comentario->comentario = 'Las pupusas de ese lugar son muy buenas, lo recomiendo';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();

        $comentario = new Comentarios();
        $comentario->id_lugar = 7;
        $comentario->id_usuario = 5;
        $comentario->comentario = 'Muy buenas las pupusas pero mal el delivery';
        $comentario->fecha = now();
        $comentario->estado = true;
        $comentario->revision = '';
        $comentario->save();
    }
}
