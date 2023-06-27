<?php

namespace App\Scope;

use App\Domain\DomainMonitoring;
use Illuminate\Database\Eloquent\Builder;

class DomainWhoisReadyScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', DomainMonitoring::Yes)
            ->where('queried_at', '<', (string) now()->subHours(3));
    }
}
