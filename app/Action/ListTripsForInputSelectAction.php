<?php

namespace App\Action;

use App\Trip;
use Illuminate\Support\Collection;

class ListTripsForInputSelectAction
{
    public function execute(): Collection
    {
        return Trip::orderByDesc('date_start')
            ->pluck('slug', 'id');
    }
}
