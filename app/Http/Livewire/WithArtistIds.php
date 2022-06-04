<?php namespace App\Http\Livewire;

use App\Action\ListArtistsForInputSelectAction;

/** @property \Illuminate\Support\Collection $artistIds */
trait WithArtistIds
{
    public function getArtistIdsProperty(ListArtistsForInputSelectAction $listArtistsForInputSelect)
    {
        return $listArtistsForInputSelect->execute();
    }
}
