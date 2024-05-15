<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GruposMusculares;
use App\Models\GruposMuscularesVideos;
class GruposMuscularesControllerlAPI extends Controller
{
    public function index()
    {
        // Obtener todas las rutinas
        $rutinas = GruposMusculares::all();

        // Retornar las rutinas como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $rutinas
        ]);
    }
    public function show($id)
    {
        // Buscar la rutina por su ID
        $rutina = GruposMusculares::find($id);

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
    public function showVideos($id)
    {
        // Buscar la rutina por su ID
        $rutina = GruposMusculares::find($id);

        // Verificar si la rutina existe
        if (!$rutina) {
            return response()->json([
                'success' => false,
                'message' => 'Rutina no encontrada'
            ], 404); // Código de respuesta 404: Not Found
        }

        // Obtener todos los ejercicios asociados a la rutina
        $ejercicios = $rutina->videos;

        // Retornar los ejercicios como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $ejercicios
        ]);
    }
    public function showVideoDetail($id)
    {
        // Buscar la rutina por su ID
        $rutina = GruposMuscularesVideos::find($id);

        // Verificar si la rutina existe
        if (!$rutina) {
            return response()->json([
                'success' => false,
                'message' => 'video no encontrada'
            ], 404); // Código de respuesta 404: Not Found
        }

        // Retornar la rutina como respuesta JSON
        return response()->json([
            'success' => true,
            'data' => $rutina
        ]);
    }
}
