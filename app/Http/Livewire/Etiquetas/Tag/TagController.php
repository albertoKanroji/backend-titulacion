<?php

namespace App\Http\Livewire\Etiquetas\Tag;

use Livewire\Component;
use App\Models\Tag;

class TagController extends Component
{
    public function render()
    {
        $equipo = Tag::all();
        return view('livewire.etiquetas.tag.tag-controller', [
            'allVideos' => $equipo
        ]);
    }
}
