<?php

namespace App\Policies;

use App\Trip;
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
