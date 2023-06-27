<?php

namespace App\Scope;

use App\Domain\MagnetStatus;
use Illuminate\Database\Eloquent\Builder;

class MagnetPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', MagnetStatus::Published);
    }
}
