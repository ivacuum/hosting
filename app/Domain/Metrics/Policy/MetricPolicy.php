<?php

namespace App\Domain\Metrics\Policy;

use App\Models\User;

class MetricPolicy
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
