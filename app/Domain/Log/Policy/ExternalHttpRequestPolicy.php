<?php

namespace App\Domain\Log\Policy;

use App\Models\User;

class ExternalHttpRequestPolicy
{
    public function delete(User $me): bool
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
