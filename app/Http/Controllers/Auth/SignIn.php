<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Ivacuum\Generic\Controllers\Auth\SignIn as BaseSignIn;

class SignIn extends BaseSignIn
{
    protected $remember = true;

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if (\Auth::attempt($credentials, $this->remember)) {
            return true;
        }

        if (null === $user = \Auth::getLastAttempted()) {
            return false;
        }

        if ($user->isPasswordOld() && $user->isOldPasswordCorrect($credentials['password'])) {
            $user->salt = '';
            $user->password = $credentials['password'];
            $user->save();

            \Auth::login($user, $this->remember);

            return true;
        }

        return false;
    }

    protected function attemptLoginCustom(Request $request)
    {
        $this->username = 'login';

        return $this->attemptLogin($request);
    }

    protected function loginCustomOkCallback()
    {
        event(new \App\Events\Stats\UserSignedInWithUsername);
    }
}
