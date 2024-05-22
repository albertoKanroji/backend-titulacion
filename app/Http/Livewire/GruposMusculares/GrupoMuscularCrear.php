<?php

namespace App\Http\Livewire\GruposMusculares;

use Livewire\Component;
use App\Models\GruposMusculares;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class GrupoMuscularCrear extends Component
{
    use WithFileUploads;
    public $showSuccesNotification  = false;
    public GruposMusculares $gm;
    public $showDemoNotification = false;
    public $nombre;
    public $imagen;
    public $descripcion;
    public $grupoMuscularId;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'imagen' => 'nullable|image|max:1024', // Ajusta el tamaño máximo según lo necesario
        'descripcion' => 'nullable|string|max:1000',
    ];

    public function render()
    {
        return view('livewire.grupos-musculares.grupo-muscular-crear');
    }
    public function mount($id = null)
    {
        if ($id) {
            $grupoMuscular = GruposMusculares::findOrFail($id);
            $this->grupoMuscularId = $grupoMuscular->id;
            $this->nombre = $grupoMuscular->nombre;
            $this->descripcion = $grupoMuscular->descripcion;
        } else {
            $this->grupoMuscularId = null;
            $this->nombre = '';
            $this->descripcion = '';
        }
    }

    public function save()
    {
        if (env('IS_DEMO')) {
            $this->showDemoNotification = true;
        } else {
            $this->validate();

            $data = [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ];

            if ($this->imagen) {
                $data['imagen'] = base64_encode(file_get_contents($this->imagen->getRealPath()));
            }

            if ($this->grupoMuscularId) {
                $grupoMuscular = GruposMusculares::findOrFail($this->grupoMuscularId);
                $grupoMuscular->update($data);
            } else {
                GruposMusculares::create($data);
            }

            $this->showSuccesNotification = true;
            $this->resetForm();
        }
    }
    public function irACrearCliente()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ];

        if ($this->imagen) {
            $data['imagen'] = base64_encode(file_get_contents($this->imagen->getRealPath()));
        }

        if ($this->grupoMuscularId) {
            $grupoMuscular = GruposMusculares::find($this->grupoMuscularId);
            $grupoMuscular->update($data);
        } else {
            GruposMusculares::create($data);
        }

        $this->showSuccesNotification = true;

        $this->resetForm();
    }

    public function edit($id)
    {
        $grupoMuscular = GruposMusculares::findOrFail($id);
        $this->grupoMuscularId = $grupoMuscular->id;
        $this->nombre = $grupoMuscular->nombre;
        $this->descripcion = $grupoMuscular->descripcion;
        $this->imagen = null; // No cargamos la imagen actual
    }

    public function resetForm()
    {
        $this->grupoMuscularId = null;
        $this->nombre = '';
        $this->imagen = null;
        $this->descripcion = '';
    }
}
