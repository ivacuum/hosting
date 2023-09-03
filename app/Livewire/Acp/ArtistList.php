<?php

namespace App\Livewire\Acp;

use App\Artist;
use Livewire\Component;
use Livewire\WithPagination;

class ArtistList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.acp.artist-list', [
            'models' => Artist::query()
                ->orderBy('title')
                ->paginate(5),
        ]);
    }
}
