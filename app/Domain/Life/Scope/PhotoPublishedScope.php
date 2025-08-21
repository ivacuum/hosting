<?php

namespace App\Domain\Life\Scope;

use App\Domain\Life\PhotoStatus;
use Illuminate\Database\Eloquent\Builder;

class PhotoPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', PhotoStatus::Published);
    }
}
