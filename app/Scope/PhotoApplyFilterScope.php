<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoApplyFilterScope
{
    public function __construct(private string|null $filter = null)
    {
    }

    public function __invoke(Builder $query)
    {
        $query
            ->when($this->filter === 'no-geo', fn (Builder $query) => $query->whereNull('point'))
            ->when($this->filter === 'no-tags', fn (Builder $query) => $query->doesntHave('tags'));
    }
}
