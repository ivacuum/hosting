<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UserEmptySalt
{
    public function handle(Login $event): void
    {
        /** @var \App\User $user */
        $user = $event->user;

        $user->salt = '';
        $user->save();
    }
}
