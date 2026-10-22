<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class MetricWeekScope
{
    public function __invoke(Builder $query): void
    {
        $query->where('date', '>', now()->subWeek()->toDateString());
    }
}
