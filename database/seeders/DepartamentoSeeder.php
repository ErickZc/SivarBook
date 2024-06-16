<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depto = new Departamento();
        $depto->departamento = 'Ahuachapán';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Cabañas';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Chalatenango';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Cuscatlán';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'La Libertad';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'La Paz';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'La Unión';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Morazán';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'San Miguel';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'San Salvador';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'San Vicente';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Santa Ana';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Sonsonate';
        $depto->save();

        $depto = new Departamento();
        $depto->departamento = 'Usulután';
        $depto->save();
    }
}
