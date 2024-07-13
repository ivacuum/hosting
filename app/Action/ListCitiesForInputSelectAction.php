<?php

namespace App\Action;

use App\City;
use Illuminate\Support\Collection;

class ListCitiesForInputSelectAction
{
    public function execute(): Collection
    {
        $titleField = City::titleField();

        return City::query()
            ->orderBy($titleField)
            ->pluck($titleField, 'id');
    }
}
