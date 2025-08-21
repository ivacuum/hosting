<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\City;
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
