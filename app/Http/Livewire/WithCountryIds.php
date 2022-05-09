<?php namespace App\Http\Livewire;

use App\Action\ListCountriesForInputSelectAction;

/** @property $countryIds */
trait WithCountryIds
{
    public function getCountryIdsProperty(ListCountriesForInputSelectAction $listCountriesForInputSelect)
    {
        return $listCountriesForInputSelect->execute();
    }
}
