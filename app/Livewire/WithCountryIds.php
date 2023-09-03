<?php

namespace App\Livewire;

use App\Action\ListCountriesForInputSelectAction;

/** @property \Illuminate\Support\Collection $countryIds */
trait WithCountryIds
{
    public function getCountryIdsProperty(ListCountriesForInputSelectAction $listCountriesForInputSelect)
    {
        return $listCountriesForInputSelect->execute();
    }
}
