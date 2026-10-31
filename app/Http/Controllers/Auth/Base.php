<?php

namespace App\Http\Controllers\Auth;

use App\Domain\UserStatus;
use App\Events\Stats\ExternalIdentityAdded;
use App\Events\Stats\UserRegisteredWithExternalIdentity;
use App\Events\Stats\UserSignedInWithExternalIdentity;
use App\Http\Controllers\Controller;
use App\Models\ExternalIdentity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Laravel\Socialite\AbstractUser;

#[Middleware('guest')]
abstract class Base extends Controller
{
    protected $provider;

    /**
     * Поиск учетки по ID в социальном сервисе
     */
    protected function findIdentityByUid(string $uid): ExternalIdentity|null
    {
        return ExternalIdentity::query()
            ->where('uid', $uid)
            ->where('provider', $this->provider)
            ->first();
    }

    /**
     * Поиск пользователя сайта по электронной почте
     */
    protected function findUserByEmail(string $email): User|null
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    /**
     * Мгновенная регистрация пользователя
     */
    protected function registerUser(AbstractUser $user): User
    {
        $newUser = new User;
        $newUser->email = $user->getEmail();
        $newUser->status = UserStatus::Active;
        $newUser->save();

        event(new UserRegisteredWithExternalIdentity);

        return $newUser;
    }

    /**
     * Вход через социальный сервис с привязкой его учетки к пользователю сайта
     */
    protected function signInWithExternalIdentity(AbstractUser $userdata): RedirectResponse
    {
        $identity = $this->findIdentityByUid($userdata->getId());

        if ($identity !== null) {
            $identity->touch();

            \Auth::loginUsingId($identity->user_id, true);

            event(new UserSignedInWithExternalIdentity);

            return redirect()->intended();
        }

        $user = $this->findUserByEmail($userdata->getEmail()) ?? $this->registerUser($userdata);

        $identity = new ExternalIdentity;
        $identity->uid = $userdata->getId();
        $identity->email = (string) $userdata->getEmail();
        $identity->provider = $this->provider;
        $identity->user_id = $user->id;
        $identity->save();

        event(new ExternalIdentityAdded);

        $user->activate();

        \Auth::login($user, true);

        return redirect()->intended();
    }

    /**
     * Сохранение адреса для перенаправления после входа
     */
    protected function saveUrlIntended(string|null $goto): void
    {
        if ($goto) {
            \Redirect::setIntendedUrl($goto);
        }
    }
}
