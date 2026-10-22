<?php

namespace App\Livewire;

use App\Domain\Life\Action\ListCitiesForInputSelectAction;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

/** @property \Illuminate\Support\Collection $cityIds */
trait WithCityIds
{
    #[Computed]
    public function cityIds(): Collection
    {
        return app(ListCitiesForInputSelectAction::class)->execute();
    }
}
