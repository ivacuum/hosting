<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class KanjiLevelScope
{
    public function __construct(private int|null $level)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->level === null) {
            return;
        }

        $query->where('level', $this->level);
    }
}
