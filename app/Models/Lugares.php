<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugares extends Model
{
    use HasFactory;

    protected $table='lugares';
    protected $primaryKey='id_lugar';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
}
