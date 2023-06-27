<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class KanjiRadicalsScope
{
    public function __construct(private int|null $radicalId)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->radicalId === null) {
            return;
        }

        $query->whereRelation('radicals', 'radical_id', $this->radicalId);
    }
}
