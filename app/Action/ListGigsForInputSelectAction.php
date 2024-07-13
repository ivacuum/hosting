<?php

namespace App\Action;

use App\Gig;
use Illuminate\Support\Collection;

class ListGigsForInputSelectAction
{
    public function execute(): Collection
    {
        return Gig::query()
            ->orderBy('slug')
            ->pluck('slug', 'id');
    }
}
