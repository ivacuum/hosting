<?php

namespace App\Scope;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class PhotoForTripsScope
{
    public function __construct(private array $ids = [])
    {
    }

    public function __invoke(Builder $query)
    {
        if (empty($this->ids)) {
            return;
        }

        $query->where('rel_type', (new Trip)->getMorphClass())
            ->whereIn('rel_id', $this->ids);
    }
}
