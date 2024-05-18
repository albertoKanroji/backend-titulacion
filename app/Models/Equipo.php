<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
    ];

    public function videos()
    {
        return $this->belongsToMany(VideoGM::class, 'equipo_videos', 'equipo_id', 'videos_gm_id');
    }
}
