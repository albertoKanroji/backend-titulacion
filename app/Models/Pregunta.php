<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $table = 'preguntas';
    protected $fillable = [
        'pregunta'
    ];

    public function respuestasOpciones()
    {
        return $this->hasMany(RespuestaOpcion::class, 'preguntas_id');
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'preguntas_id');
    }
}
