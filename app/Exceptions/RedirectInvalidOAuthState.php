<?php

namespace App\Exceptions;

use App\Domain\SessionKey;
use Laravel\Socialite\Two\InvalidStateException;

class RedirectInvalidOAuthState
{
    public function __invoke(InvalidStateException $e)
    {
        return redirect(to('auth/login'))
            ->with(SessionKey::FlashMessage->value, __('auth.external_signin_expired'));
    }
}
