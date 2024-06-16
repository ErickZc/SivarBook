<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $table='comentarios';
    protected $primaryKey='id_comentario';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugares::class, 'id_lugar');
    }

}
