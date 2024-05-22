<?php

namespace App\Http\Livewire\GruposMusculares;

use Livewire\Component;
use App\Models\GruposMusculares;

class GruposMuscularesController extends Component
{
    public $gruposMusculares;
    public function editCliente($id)
    {

        return redirect()->route('gm-crear', ['id' => $id]);
    }




    public function mount()
    {
        $this->gruposMusculares = GruposMusculares::all();
    }
    public function render()
    {

        return view('livewire.grupos-musculares.grupos-musculares-controller');
    }
    public function borrarCliente($id)
    {
        $cliente = GruposMusculares::find($id);

        if ($cliente) {
            $cliente->delete();
            session()->flash('message', 'Cliente borrado exitosamente.');
        } else {
            session()->flash('message', 'No se pudo encontrar el cliente.');
        }

        // Actualizar la lista de clientes después de borrar
        $this->gruposMusculares = GruposMusculares::all();
    }
}
