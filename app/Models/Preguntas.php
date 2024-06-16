<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    use HasFactory;

    protected $table='preguntas';
    protected $primaryKey='id_pregunta';
    public $timestamps=false;

    protected $fillable = [
        'id_pregunta',
        'pregunta',
    ];
}
