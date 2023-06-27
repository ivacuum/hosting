<?php

namespace App\Scope;

use App\Domain\PhotoStatus;
use Illuminate\Database\Eloquent\Builder;

class PhotoPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', PhotoStatus::Published);
    }
}
