<?php

namespace App\Action;

use App\Artist;
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
