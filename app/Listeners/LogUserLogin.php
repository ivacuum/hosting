<?php namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogUserLogin
{
    public function handle(Login $event)
    {
        event(new \App\Events\Stats\UserSignedIn);

        /* @var $user \App\User */
        $user = $event->user;

        $user->ip = request()->ip();
        $user->last_login_at = now();
        $user->save();
    }
}
