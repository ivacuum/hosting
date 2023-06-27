<?php

namespace App\Scope;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class PhotoForTripScope
{
    public function __construct(private int|null $id = null)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->id === null) {
            return;
        }

        $query->where('rel_type', (new Trip)->getMorphClass())
            ->where('rel_id', $this->id);
    }
}
