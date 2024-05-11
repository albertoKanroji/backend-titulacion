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
}
