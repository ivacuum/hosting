<?php

namespace App\Scope;

use App\Domain\Life\Models\Trip;
use App\Domain\Magnet\Models\Magnet;
use App\Issue;
use App\News;
use Illuminate\Database\Eloquent\Builder;

class CommentRelationScope
{
    public function __construct(
        private Issue|Magnet|News|Trip $relation,
        private int|null $relationId = null,
    ) {}

    public function __invoke(Builder $query)
    {
        $query->where('rel_type', $this->relation->getMorphClass())
            ->when($this->relationId, fn (Builder $query) => $query->where('rel_id', $this->relationId));
    }
}
