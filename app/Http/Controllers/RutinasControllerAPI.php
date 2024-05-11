<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutinas;

class RutinasControllerAPI extends Controller
{
    //
    public function index()
    {
        // Obtener todas las rutinas
        $rutinas = Rutinas::all();

        // Retornar las rutinas como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $rutinas
        ]);
    }
}
