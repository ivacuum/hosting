<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class PhotoOnMapScope
{
    public function __invoke(Builder $query)
    {
        $query->whereNotNull('point');
    }
}
