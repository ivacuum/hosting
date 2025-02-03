<?php

namespace App\Livewire\Acp;

use App\Artist;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property \Illuminate\Database\Eloquent\Collection<int, Artist>|\Illuminate\Contracts\Pagination\LengthAwarePaginator $models
 */
class ArtistList extends Component
{
    use WithPagination;

    #[Computed]
    public function models()
    {
        return Artist::query()
            ->orderBy('title')
            ->paginate(5);
    }
}
