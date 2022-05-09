<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoApplyFilterScope
{
    public function __construct(private ?string $filter = null)
    {
    }

    public function __invoke(Builder $query)
    {
        $query
            ->when($this->filter === 'no-geo', fn (Builder $query) => $query->where('lat', '')->where('lon', ''))
            ->when($this->filter === 'no-tags', fn (Builder $query) => $query->doesntHave('tags'));
    }
}
