<?php namespace App\Policies;

use App\User;

class WithoutCreateAndEdit extends Base
{
    public function create(User $me)
    {
        return false;
    }

    public function edit(User $me)
    {
        return false;
    }
}
