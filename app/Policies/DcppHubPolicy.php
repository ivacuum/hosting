<?php namespace App\Policies;

use App\User;

class DcppHubPolicy
{
    public function create(User $me)
    {
        return $me->isRoot();
    }

    public function delete(User $me)
    {
        return $me->isRoot();
    }

    public function update(User $me)
    {
        return $me->isRoot();
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
