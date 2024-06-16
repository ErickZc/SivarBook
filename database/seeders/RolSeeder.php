<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol = new Rol();
        $rol->nombre_rol = 'ADMINISTRADOR';
        $rol->estado = true;
        $rol->save();

        $rol = new Rol();
        $rol->nombre_rol = 'MODERADOR';
        $rol->estado = true;
        $rol->save();

        $rol = new Rol();
        $rol->nombre_rol = 'TURISTA';
        $rol->estado = true;
        $rol->save();

        $rol = new Rol();
        $rol->nombre_rol = 'EMPRENDEDOR';
        $rol->estado = true;
        $rol->save();
    }
}
