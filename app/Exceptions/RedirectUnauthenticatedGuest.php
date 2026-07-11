<?php

namespace App\Exceptions;

use App\Domain\SessionKey;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class RedirectUnauthenticatedGuest
{
    public function __invoke(AuthenticationException $e, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return redirect()
            ->guest(to('auth/login'))
            ->with(SessionKey::FlashMessage->value, __('auth.signin_to_view_page'));
    }
}
