<?php

namespace App\Http\Livewire\Videos;

use Livewire\Component;
use App\Models\GruposMusculares;

class VideosEjercicios extends Component
{
    public $allVideos;

    public function mount()
    {
        // Obtener todos los grupos musculares con sus videos
        $gruposMusculares = GruposMusculares::with('videos')->get();

        // Recolectar todos los videos en una colección plana con su grupo muscular
        $this->allVideos = $gruposMusculares->flatMap(function ($grupoMuscular) {
            return $grupoMuscular->videos->map(function ($video) use ($grupoMuscular) {
                $video->grupoMuscular = $grupoMuscular->nombre;
                return $video;
            });
        });
    }

    public function render()
    {
        return view('livewire.videos.videos-ejercicios', [
            'allVideos' => $this->allVideos
        ]);
    }
}
