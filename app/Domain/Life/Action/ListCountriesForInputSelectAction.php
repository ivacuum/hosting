<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Country;
use Illuminate\Support\Collection;

class ListCountriesForInputSelectAction
{
    public function execute(): Collection
    {
        $titleField = Country::titleField();

        return Country::query()
            ->orderBy($titleField)
            ->pluck($titleField, 'id');
    }
}
