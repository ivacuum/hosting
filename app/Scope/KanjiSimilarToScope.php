<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class KanjiSimilarToScope
{
    public function __construct(private int|null $similarToId)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->similarToId === null) {
            return;
        }

        $query->whereRelation('similar', 'similar_id', $this->similarToId);
    }
}
