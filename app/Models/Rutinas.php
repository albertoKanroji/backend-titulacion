<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutinas extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'rutinas';
    protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
        

    ];
}
