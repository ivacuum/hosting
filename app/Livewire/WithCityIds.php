<?php

namespace App\Livewire;

use App\Action\ListCitiesForInputSelectAction;
use Livewire\Attributes\Computed;

/** @property \Illuminate\Support\Collection $cityIds */
trait WithCityIds
{
    #[Computed]
    public function cityIds()
    {
        return app(ListCitiesForInputSelectAction::class)->execute();
    }
}
