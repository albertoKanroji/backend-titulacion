<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customers;
use App\Models\Rutinas;
use App\Models\GruposMusculares;
use App\Models\Ejercicios;

class Dashboard extends Component
{

    public $totalClientes;
    public $totalRutinasPersonalizadas;
    public $totalVideos;
    public $totalEjercicios;

    public function mount()
    {
        $gruposMusculares = GruposMusculares::with('videos')->get();

        // Obtener los totales de cada entidad
        $this->totalClientes = Customers::count();
        $this->totalRutinasPersonalizadas = Rutinas::count();
        $allVideos = $gruposMusculares->flatMap(function ($grupoMuscular) {
            return $grupoMuscular->videos;
        });

        // Contar todos los videos
        $this->totalVideos = $allVideos->count();
        $this->totalEjercicios = Ejercicios::count();
    }
    public function render()
    {
        return view('livewire.dashboard', [
            'totalClientes' => $this->totalClientes,
            'totalRutinasPersonalizadas' => $this->totalRutinasPersonalizadas,
            'totalVideos' => $this->totalVideos,
            'totalEjercicios' => $this->totalEjercicios,
        ]);
    }
}
