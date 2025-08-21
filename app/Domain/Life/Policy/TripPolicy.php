<?php

namespace App\Domain\Life\Policy;

use App\Domain\Life\Models\Trip;
use App\User;

class TripPolicy
{
    public function create(User $me)
    {
        return $me->isRoot();
    }

    public function delete(User $me, Trip $trip)
    {
        return $me->isRoot()
            || $me->id === $trip->user_id;
    }

    public function update(User $me, Trip $trip)
    {
        return $me->isRoot()
            || $me->id === $trip->user_id;
    }

    public function view(User $me)
    {
        return $me->isRoot();
    }

    public function viewAny(User $me)
    {
        return $me->isRoot();
    }
}
