<?php

namespace App\Http\Controllers\Auth;

use App\Events\Stats\ExternalIdentityAdded;
use App\Events\Stats\UserRegisteredWithExternalIdentity;
use App\ExternalIdentity;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\AbstractUser;

abstract class Base extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Поиск или создание новой учетки социального сервиса
     */
    protected function externalIdentity(AbstractUser $user): ExternalIdentity
    {
        $identity = $this->findIdentityByUid($user->getId());

        if ($identity === null) {
            $identity = $this->saveExternalIdentity($user);
        } else {
            $identity->touch();
        }

        return $identity;
    }

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
        $newUser->status = User::STATUS_ACTIVE;
        $newUser->save();

        event(new UserRegisteredWithExternalIdentity);

        return $newUser;
    }

    /**
     * Сохранение поступивших от социального сервиса данных
     */
    protected function saveExternalIdentity(AbstractUser $user): ExternalIdentity
    {
        $externalIdentity = new ExternalIdentity;
        $externalIdentity->uid = $user->getId();
        $externalIdentity->email = (string) $user->getEmail();
        $externalIdentity->provider = $this->provider;
        $externalIdentity->save();

        event(new ExternalIdentityAdded);

        return $externalIdentity;
    }

    /**
     * Сохранение адреса для перенаправления после входа
     */
    protected function saveUrlIntended(): bool
    {
        $goto = request('goto');

        if ($goto) {
            \Redirect::setIntendedUrl($goto);
        }

        return true;
    }
}
