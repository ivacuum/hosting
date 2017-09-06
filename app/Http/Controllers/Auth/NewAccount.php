<?php namespace App\Http\Controllers\Auth;

use App\User;
use Ivacuum\Generic\Controllers\Auth\NewAccount as BaseNewAccount;

class NewAccount extends BaseNewAccount
{
    protected function registeredResponse(User $user)
    {
        $user->activate();

        return parent::registeredResponse($user);
    }
}
