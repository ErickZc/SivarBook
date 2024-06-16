<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Valoraciones;
use App\Models\Categorias;
use App\Models\Departamento;
use App\Models\Rol;
use App\Models\Municipio;
use App\Models\Usuarios;
use App\Models\Preguntas;
use App\Models\Lugares;
use App\Models\Lugares_Valoraciones;
use App\Models\Comentarios;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ValoracionesSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(PreguntasSeeder::class);
        $this->call(LugaresSeeder::class);
        $this->call(LugaresValoracionesSeeder::class);
        $this->call(ComentariosSeeder::class);
    }
}
