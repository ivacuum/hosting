<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoForTagScope
{
    public function __construct(private ?int $id = null)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->id === null) {
            return;
        }

        $query->whereRelation('tags', 'tag_id', $this->id);
    }
}
