<?php

namespace App\Http\Livewire\Rutinas;

use Livewire\Component;
use App\Models\Rutinas;

class RutinasPersonalizadaController extends Component
{
    public $rutinas;

    public function mount()
    {
        // Obtener todas las rutinas públicas
        $this->rutinas = Rutinas::where('estado', 'personalizada')->get();
    }
    public function render()
    {
        return view('livewire.rutinas.rutinas-personalizada-controller', [
            'rutinas' => $this->rutinas
        ]);
    }
}
