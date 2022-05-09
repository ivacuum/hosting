<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class CommentRelationScope
{
    public function __construct(private string $type)
    {
    }

    public function __invoke(Builder $query)
    {
        $query->where('rel_type', $this->type);
    }
}
