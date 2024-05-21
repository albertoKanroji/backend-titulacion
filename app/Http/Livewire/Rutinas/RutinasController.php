<?php

namespace App\Http\Livewire\Rutinas;

use App\Models\Rutinas;
use Livewire\Component;

class RutinasController extends Component
{
    public $rutinas;

    public function mount()
    {
        // Obtener todas las rutinas públicas
        $this->rutinas = Rutinas::where('estado', 'publica')->get();
    }

    public function render()
    {
        return view('livewire.rutinas.rutinas-controller', [
            'rutinas' => $this->rutinas
        ]);
    }
}
