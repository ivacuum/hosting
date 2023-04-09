<?php namespace App\Scope;

use App\Magnet;
use App\News;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class CommentRelationScope
{
    public function __construct(private Magnet|News|Trip $relation)
    {
    }

    public function __invoke(Builder $query)
    {
        $query->where('rel_type', $this->relation->getMorphClass());
    }
}
