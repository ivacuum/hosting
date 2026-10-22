<?php

namespace App\Policies;

use App\User;

class ChatMessagePolicy
{
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
