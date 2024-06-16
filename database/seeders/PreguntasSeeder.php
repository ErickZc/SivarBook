<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Preguntas;

class PreguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál fue el nombre de tu primera mascota?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es el nombre de la calle donde creciste?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál era el nombre de tu escuela primaria?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿En qué ciudad naciste?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es el nombre de tu mejor amigo/a de la infancia?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es tu comida favorita?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es el nombre de tu primer jefe?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cómo se llamaba tu primer auto?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es el nombre de tu libro favorito?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál es el nombre de tu abuela materna?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Cuál fue tu primer trabajo?';
        $preguntas->save();

        $preguntas = new Preguntas();
        $preguntas->pregunta = '¿Dónde pasaste tus vacaciones más memorables?';
        $preguntas->save();

    }
}
