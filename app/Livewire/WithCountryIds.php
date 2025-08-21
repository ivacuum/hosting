<?php

namespace App\Livewire;

use App\Domain\Life\Action\ListCountriesForInputSelectAction;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

/** @property \Illuminate\Support\Collection $countryIds */
trait WithCountryIds
{
    #[Computed]
    public function countryIds(): Collection
    {
        return app(ListCountriesForInputSelectAction::class)->execute();
    }
}
