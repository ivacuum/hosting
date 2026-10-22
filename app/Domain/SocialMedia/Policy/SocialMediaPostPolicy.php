<?php

namespace App\Domain\SocialMedia\Policy;

use App\User;

class SocialMediaPostPolicy
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
