<?php

namespace App\Domain\Life\Policy;

use App\Models\User;

class CountryPolicy
{
    public function create(User $me): bool
    {
        return $me->isRoot();
    }

    public function delete(User $me): bool
    {
        return $me->isRoot();
    }

    public function update(User $me): bool
    {
        return $me->isRoot();
    }

    public function view(User $me): bool
    {
        return $me->isRoot();
    }

    public function viewAny(User $me): bool
    {
        return $me->isRoot();
    }
}
