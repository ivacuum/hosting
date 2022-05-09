<?php namespace App\Scope;

use App\Domain\UserStatus;
use Illuminate\Database\Eloquent\Builder;

class UserActiveScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', UserStatus::Active);
    }
}
