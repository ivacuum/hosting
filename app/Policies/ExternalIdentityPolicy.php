<?php namespace App\Policies;

use App\User;

class ExternalIdentityPolicy
{
    public function delete(User $me)
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
