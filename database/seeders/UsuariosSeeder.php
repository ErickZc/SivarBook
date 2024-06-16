<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Imagen por defecto
        $path1 = public_path('img/Vector_DM.webp');
        $imagenBinaria1 = file_get_contents($path1);
        $imagenBase641 = base64_encode($imagenBinaria1);

        $path2 = public_path('img/hombrecito-blanco-pantera-rosa.webp');
        $imagenBinaria2 = file_get_contents($path2);
        $imagenBase642 = base64_encode($imagenBinaria2);

        $path3 = public_path('img/Death.jpg');
        $imagenBinaria3 = file_get_contents($path3);
        $imagenBase643 = base64_encode($imagenBinaria3);

        $path4 = public_path('img/Margo_Gru.webp');
        $imagenBinaria4 = file_get_contents($path4);
        $imagenBase644 = base64_encode($imagenBinaria4);

        $path5 = public_path('img/gato.jpg');
        $imagenBinaria5 = file_get_contents($path5);
        $imagenBase645 = base64_encode($imagenBinaria5);

        $path6 = public_path('img/SHK1LordFarquaad.webp');
        $imagenBinaria6 = file_get_contents($path6);
        $imagenBase646 = base64_encode($imagenBinaria6);


        //ADMINISTRADOR
        $usuarios = new Usuarios();
        $usuarios->nombre = 'Erick Alexander';
        $usuarios->apellido = 'Zaldana Cruz';
        $usuarios->edad = 25;
        $usuarios->correo = 'erick@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase642;
        $usuarios->id_rol = 1;
        $usuarios->save();

        //TURISTA
        $usuarios = new Usuarios();
        $usuarios->nombre = 'Kenya Guadalupe';
        $usuarios->apellido = 'Mejia Figueroa';
        $usuarios->edad = 25;
        $usuarios->correo = 'kenya@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase644;
        $usuarios->id_rol = 3;
        $usuarios->save();

        //EMPRENDEDOR
        $usuarios = new Usuarios();
        $usuarios->nombre = 'Pedro Arturo';
        $usuarios->apellido = 'Campos Rivas';
        $usuarios->edad = 25;
        $usuarios->correo = 'pedro@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase643;
        $usuarios->id_rol = 4;
        $usuarios->save();

        $usuarios = new Usuarios();
        $usuarios->nombre = 'Francisco Armando';
        $usuarios->apellido = 'Paredes';
        $usuarios->edad = 30;
        $usuarios->correo = 'francisco@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase641;
        $usuarios->id_rol = 4;
        $usuarios->save();

        //TURISTA
        $usuarios = new Usuarios();
        $usuarios->nombre = 'Ana Lidia';
        $usuarios->apellido = 'Cruz Cordova';
        $usuarios->edad = 40;
        $usuarios->correo = 'ana@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase645;
        $usuarios->id_rol = 3;
        $usuarios->save();

        $usuarios = new Usuarios();
        $usuarios->nombre = 'Juan Carlos';
        $usuarios->apellido = 'Perez Cardona';
        $usuarios->edad = 20;
        $usuarios->correo = 'juan@gmail.com';
        $usuarios->password = '$2y$12$XRRErq3ArJ.6rfK0dnTwJ.XPq30DITp6v1OwUJX3Ex3jHeU6Mkhg.';
        $usuarios->estado = true;
        $usuarios->fechaCreacion = now();
        $usuarios->imagen = $imagenBase646;
        $usuarios->id_rol = 3;
        $usuarios->save();


    }
}
