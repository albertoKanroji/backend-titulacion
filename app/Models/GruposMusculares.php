<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GruposMusculares extends Model
{
    use HasFactory;
    protected $table = 'grupos_musculares';
    protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
        

    ];
    public function videos(): HasMany
    {
        return $this->hasMany(GruposMuscularesVideos::class, 'gm_id'); // Ajusta el nombre de la clave foránea según corresponda en tu base de datos
    }
}
