<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Valoraciones;

class ValoracionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $valoraciones = new Valoraciones();
        $valoraciones->valoracion = 'Muy Malo';
        $valoraciones->save();

        $valoraciones = new Valoraciones();
        $valoraciones->valoracion = 'Malo';
        $valoraciones->save();

        $valoraciones = new Valoraciones();
        $valoraciones->valoracion = 'Normal';
        $valoraciones->save();

        $valoraciones = new Valoraciones();
        $valoraciones->valoracion = 'Bueno';
        $valoraciones->save();

        $valoraciones = new Valoraciones();
        $valoraciones->valoracion = 'Excelente';
        $valoraciones->save();
    }
}
