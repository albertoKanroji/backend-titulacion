<?php

namespace App\Http\Livewire\Etiquetas\Equipo;

use Livewire\Component;
use App\Models\Equipo;

class EquipoController extends Component
{
    public function render()
    {
        $equipo = Equipo::all();
        return view('livewire.etiquetas.equipo.equipo-controller', [
            'allVideos' => $equipo
        ]);
    }
}
