<?php

namespace App\Domain\Magnet\Scope;

use App\Domain\Magnet\MagnetStatus;
use Illuminate\Database\Eloquent\Builder;

class MagnetPublishedScope
{
    public function __invoke(Builder $query): void
    {
        $query->where('status', MagnetStatus::Published);
    }
}
