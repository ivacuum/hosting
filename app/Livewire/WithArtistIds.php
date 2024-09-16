<?php

namespace App\Livewire;

use App\Action\ListArtistsForInputSelectAction;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

/** @property \Illuminate\Support\Collection $artistIds */
trait WithArtistIds
{
    #[Computed]
    public function artistIds(): Collection
    {
        return app(ListArtistsForInputSelectAction::class)->execute();
    }
}
