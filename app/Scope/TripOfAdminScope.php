<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class TripOfAdminScope
{
    public function __invoke(Builder $query)
    {
        $query->where('user_id', 1);
    }
}
