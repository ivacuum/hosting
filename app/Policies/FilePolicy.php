<?php

namespace App\Policies;

use App\Models\User;

class FilePolicy
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
