<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas_Usuarios extends Model
{
    use HasFactory;

    protected $table='preguntas_usuario';
    protected $primaryKey='id';
    public $timestamps=false;

    protected $fillable = [
        'id_usuario',
        'id_pregunta',
        'respuesta',
    ];

    // Relación con usuarios (si es necesario)
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_usuario', 'id_usuario');
    }
}
