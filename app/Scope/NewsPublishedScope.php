<?php

namespace App\Scope;

use App\Domain\NewsStatus;
use Illuminate\Database\Eloquent\Builder;

class NewsPublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', NewsStatus::Published);
    }
}
