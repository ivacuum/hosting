<?php namespace App\Policies;

use App\Trip;
use App\User;
use Ivacuum\Generic\Policies\Base;

class TripPolicy extends Base
{
    public function userDelete(User $me, Trip $trip)
    {
        return $me->id === $trip->user_id;
    }

    public function userUpdate(User $me, Trip $trip)
    {
        return $me->id === $trip->user_id;
    }
}
