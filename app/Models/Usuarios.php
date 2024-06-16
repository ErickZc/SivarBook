<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol; // Importa el modelo Rol aquí

class Usuarios extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'edad',
        'correo',
        'password',
        'estado',
        'imagen',
        'fechaCreacion',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function isAdmin()
    {
        // Aquí implementamos la lógica para verificar si el usuario tiene el rol de administrador
        return $this->id_rol === 1; // ID 1 corresponde al rol de administrador
    }

    public function isTurista()
    {
        // Aquí implementamos la lógica para verificar si el usuario tiene el rol de usuario
        return $this->id_rol === 3; // ID 3 corresponde al rol de usuario
    }

    public function isEmprendedor()
    {
        // Aquí implementamos la lógica para verificar si el usuario tiene el rol de emprendedor
        return $this->id_rol === 4; // ID 4 corresponde al rol de emprendedor
    }
}
