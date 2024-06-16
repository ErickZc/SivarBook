<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lugares_Valoraciones;

class LugaresValoracionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Tacos Benito Carca
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 1;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 2;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 1;
        $valoracion->id_valoracion = 4;
        $valoracion->id_usuario = 5;
        $valoracion->descripcion = '';
        $valoracion->save();

        //La puerta del diablo
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 2;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 5;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 2;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 6;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 2;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 2;
        $valoracion->descripcion = '';
        $valoracion->save();

        //El pital
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 3;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 2;
        $valoracion->descripcion = '';
        $valoracion->save();

        //Playa El Tunco
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 4;
        $valoracion->id_valoracion = 4;
        $valoracion->id_usuario = 2;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 4;
        $valoracion->id_valoracion = 4;
        $valoracion->id_usuario = 5;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 4;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 6;
        $valoracion->descripcion = '';
        $valoracion->save();

        //YALI Hotel & Resort
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 5;
        $valoracion->id_valoracion = 4;
        $valoracion->id_usuario = 6;
        $valoracion->descripcion = '';
        $valoracion->save();

        //BINAES El Salvador
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 6;
        $valoracion->id_valoracion = 4;
        $valoracion->id_usuario = 5;
        $valoracion->descripcion = '';
        $valoracion->save();

        //Pupuseria Suiza
        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 7;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 5;
        $valoracion->descripcion = '';
        $valoracion->save();

        $valoracion = new Lugares_Valoraciones();
        $valoracion->fecha = now();
        $valoracion->id_lugar = 7;
        $valoracion->id_valoracion = 5;
        $valoracion->id_usuario = 6;
        $valoracion->descripcion = '';
        $valoracion->save();

    }
}
