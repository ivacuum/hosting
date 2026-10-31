<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        event(new \App\Events\Stats\UserSignedIn);

        /** @var \App\Models\User $user */
        $user = $event->user;

        $user->ip = request()->ip();
        $user->last_login_at = now();
        $user->save();
    }
}
