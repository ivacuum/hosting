<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Http\Requests\Auth\ExternalCallbackForm;
use App\Http\Requests\Auth\GoogleRedirectForm;

/**
 * Вход через Гугл
 *
 * Настройка сайта: console.developers.google.com
 */
class Google extends Base
{
    #[\Override]
    protected $provider = 'google';

    public function index(GoogleRedirectForm $request)
    {
        $this->saveUrlIntended($request->goto);

        return \Socialite::driver('google')->redirect();
    }

    public function callback(ExternalCallbackForm $request)
    {
        if ($request->hasError) {
            return redirect(path([SignIn::class, 'index']));
        }

        /** @var \Laravel\Socialite\Two\User $userdata */
        $userdata = \Socialite::driver('google')->user();

        if ($userdata->getEmail() === null) {
            return redirect(path([SignIn::class, 'index']))
                ->with(SessionKey::FlashMessage->value, 'Мы не можем вас зарегистрировать, так как не получили от Гугла вашу электронную почту');
        }

        return $this->signInWithExternalIdentity($userdata);
    }
}
