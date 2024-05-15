<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Customers;

use Illuminate\Support\Facades\Hash;

class CrearClientesController extends Component
{

    public Customers $cliente;
    public $showSuccesNotification  = false;

    public $showDemoNotification = false;



    protected $rules = [
        'cliente.nombre' => 'max:40|min:3',
        'cliente.correo' => 'min:8',
        'cliente.apellido' => 'min:5',
        'cliente.apellido2' => 'min:5',
        'cliente.password' => 'min:5',
        'cliente.status' => 'min:1',
     
    ];
    public function save()
    {
        if (env('IS_DEMO')) {
            $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->cliente->irACrearCliente();
            $this->showSuccesNotification = true;
        }
    }
    // Propiedades para almacenar los datos del cliente
    public $nombre;
    public $apellido;
    public $apellido2;
    public $correo;
    public $password;
    public $status;
    public function mount()
    {
        $this->cliente = new Customers();
        $this->status="select";
    }

    // Función para crear un nuevo cliente

    public function irACrearCliente()
    {
        try {

            // Encriptar la contraseña
            $passwordEncriptada = Hash::make($this->password);

            // Crear un nuevo cliente en la base de datos
            Customers::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'apellido2' => $this->apellido2,
                'correo' => $this->correo,
                'password' => $passwordEncriptada,
                'status' => $this->status,
            ]);
            $this->showSuccesNotification = true;

            // Redireccionar o mostrar un mensaje de éxito
        } catch (\Exception $e) {
            $this->showDemoNotification = true;
        }
    }

    // Función para editar un cliente existente
    public function editarCliente($id)
    {
        // Encuentra el cliente por su ID
        $cliente = Customers::findOrFail($id);

        // Validación de los datos
        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|unique:customers,correo,' . $cliente->id,
            'password' => 'required',
            'status' => 'required|boolean',
        ]);

        // Actualizar los datos del cliente
        $cliente->update([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'apellido2' => $this->apellido2,
            'correo' => $this->correo,
            'password' => $this->password,
            'status' => $this->status,
        ]);

        // Redireccionar o mostrar un mensaje de éxito
    }

    public function render()
    {
        return view('livewire.clientes.crear-clientes-controller');
    }
}
