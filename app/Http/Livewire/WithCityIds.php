<?php namespace App\Http\Livewire;

use App\Action\ListCitiesForInputSelectAction;

/** @property $cityIds */
trait WithCityIds
{
    public function getCityIdsProperty(ListCitiesForInputSelectAction $listCitiesForInputSelect)
    {
        return $listCitiesForInputSelect->execute();
    }
}
