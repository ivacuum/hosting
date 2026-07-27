<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserSignedInWithExternalIdentity;
use App\Http\Requests\Auth\ExternalCallbackForm;
use App\Http\Requests\Auth\FacebookRedirectForm;
use Illuminate\Support\HtmlString;

class Facebook extends Base
{
    #[\Override]
    protected $provider = 'facebook';

    public function index(FacebookRedirectForm $request)
    {
        $driver = \Socialite::driver('facebook');

        if ($request->shouldRerequest) {
            $driver = $driver->reRequest();
        }

        $this->saveUrlIntended($request->goto);

        return $driver->redirect();
    }

    public function callback(ExternalCallbackForm $request)
    {
        if ($request->hasError) {
            return redirect(path([SignIn::class, 'index']));
        }

        /** @var \Laravel\Socialite\Two\User $userdata */
        $userdata = \Socialite::driver('facebook')->user();

        if ($userdata->getEmail() === null) {
            return redirect(path([SignIn::class, 'index']))
                ->with(SessionKey::FlashMessage->value, $this->noEmailMessage());
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

    protected function noEmailMessage(): HtmlString
    {
        return new HtmlString('<div>Мы не можем вас зарегистрировать, так как не получили от Фэйсбука вашу электронную почту. Доступ к ее адресу можно разрешить при <a class="link" href="' . path([static::class, 'index'], ['rerequest' => 1]) . '">повторной попытке</a></div>');
    }
}
