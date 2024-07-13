<?php

namespace App\Action;

use App\Country;
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
