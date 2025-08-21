<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Gig;
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
