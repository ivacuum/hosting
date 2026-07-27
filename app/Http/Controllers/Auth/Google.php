<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserSignedInWithExternalIdentity;
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

        $identity = $this->externalIdentity($userdata);

        if ($identity->user_id) {
            \Auth::loginUsingId($identity->user_id);

            event(new UserSignedInWithExternalIdentity);

            return redirect()->intended();
        }

        if (null === $user = $this->findUserByEmail($userdata->getEmail())) {
            $user = $this->registerUser($userdata);
        }

        if (!$identity->user_id) {
            $identity->user_id = $user->id;
            $identity->save();
        }

        $user->activate();

        \Auth::login($user, true);

        return redirect()->intended();
    }
}
