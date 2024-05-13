<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Customers;
use Illuminate\Support\Facades\Route;

class ClientesController extends Component
{
    public $clientes;

    public function mount()
    {

        $this->clientes = Customers::all();
    }
    public function irACrearCliente()
    {
        return redirect()->route('clientes-crear');
    }
    public function render()
    {
        return view('livewire.clientes.clientes-controller');
    }
    public function borrarCliente($id)
    {
        $cliente = Customers::find($id);

        if ($cliente) {
            $cliente->delete();
            session()->flash('message', 'Cliente borrado exitosamente.');
        } else {
            session()->flash('message', 'No se pudo encontrar el cliente.');
        }

        // Actualizar la lista de clientes después de borrar
        $this->clientes = Customers::all();
    }
}
