<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugares_Valoraciones extends Model
{
    use HasFactory;

    protected $table='lugares_valoraciones';
    protected $primaryKey='id_lValoracion';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugares::class, 'id_lugar');
    }

    public function valoracion()
    {
        return $this->belongsTo(Valoraciones::class, 'id_valoracion');
    }
}
