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
    public function show($id)
    {
        // Buscar la rutina por su ID
        $rutina = Rutinas::find($id);

        // Verificar si la rutina existe
        if (!$rutina) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404); // Código de respuesta 404: Not Found
        }

        // Retornar la rutina como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $rutina
        ]);
    }
    public function showEjercicios($id)
    {
        // Buscar la rutina por su ID
        $rutina = Rutinas::find($id);

        // Verificar si la rutina existe
        if (!$rutina) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404); // Código de respuesta 404: Not Found
        }

        // Obtener todos los ejercicios asociados a la rutina
        $ejercicios = $rutina->ejercicios;

        // Retornar los ejercicios como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $ejercicios
        ]);
    }
}
