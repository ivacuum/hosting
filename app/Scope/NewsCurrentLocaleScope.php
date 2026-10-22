<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class NewsCurrentLocaleScope
{
    public function __invoke(Builder $query): void
    {
        $query->where('locale', \App::getLocale());
    }
}
