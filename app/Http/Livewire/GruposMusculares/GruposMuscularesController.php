<?php

namespace App\Http\Livewire\GruposMusculares;

use Livewire\Component;
use App\Models\GruposMusculares;

class GruposMuscularesController extends Component
{


    public function mount()
    {
    }
    public function render()
    {
        $gruposMusculares = GruposMusculares::all();
        //dd($gruposMusculares);
        return view('livewire.grupos-musculares.grupos-musculares-controller', [
            'allVideos' => $gruposMusculares
        ]);
    }
}
