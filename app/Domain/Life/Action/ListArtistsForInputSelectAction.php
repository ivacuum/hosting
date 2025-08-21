<?php

namespace App\Domain\Life\Action;

use App\Domain\Life\Models\Artist;
use Illuminate\Support\Collection;

class ListArtistsForInputSelectAction
{
    public function execute(): Collection
    {
        return Artist::query()
            ->orderBy('title')
            ->pluck('title', 'id');
    }
}
