<?php

namespace App\Domain\Life\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoOnMapScope
{
    public function __invoke(Builder $query): void
    {
        $query->whereNotNull('point');
    }
}
