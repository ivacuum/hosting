<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserSignedInWithExternalIdentity;
use App\Http\Requests\Auth\ExternalCallbackForm;
use App\Http\Requests\Auth\VkRedirectForm;
use App\Socialite\VkProvider;
use Illuminate\Support\HtmlString;

class Vk extends Base
{
    #[\Override]
    protected $provider = 'vk';

    public function index(VkRedirectForm $request)
    {
        /** @var VkProvider $driver */
        $driver = \Socialite::driver('vk');

        if ($request->shouldRevoke) {
            $driver = $driver->revoke();
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
        $userdata = \Socialite::driver('vk')->user();

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
        return new HtmlString('<div>Мы не можем вас зарегистрировать, так как не получили от ВК вашу электронную почту. Доступ к ее адресу можно разрешить при <a class="link" href="' . path([static::class, 'index'], ['revoke' => 1]) . '">повторной попытке</a></div>');
    }
}
