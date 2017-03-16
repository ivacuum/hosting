<?php namespace App\Policies;

use App\User;

class WithoutCreate extends Base
{
    public function create(User $me)
    {
        return false;
    }
}
