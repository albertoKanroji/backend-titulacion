<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GruposMuscularesVideos extends Model
{
    use HasFactory;
    protected $table = 'videos_gm';
    protected $fillable = [
        'nombre',
        'miniatura',
        'descripcion',
        'gm_id',
        'video_url'
        

    ];
}
