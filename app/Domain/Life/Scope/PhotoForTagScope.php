<?php

namespace App\Domain\Life\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoForTagScope
{
    public function __construct(private int|null $id = null) {}

    public function __invoke(Builder $query): void
    {
        if ($this->id === null) {
            return;
        }

        $query->whereRelation('tags', 'tag_id', $this->id);
    }
}
