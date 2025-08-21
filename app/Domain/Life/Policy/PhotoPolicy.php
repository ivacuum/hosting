<?php

namespace App\Domain\Life\Policy;

use App\User;

class PhotoPolicy
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
