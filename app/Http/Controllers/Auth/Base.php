<?php namespace App\Http\Controllers\Auth;

use App\Events\ExternalIdentitySaved;
use App\ExternalIdentity;
use App\Http\Controllers\Controller;
use App\User;

abstract class Base extends Controller
{
    protected $provider;
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;

        $this->middleware('guest');
    }

    /**
     * Поиск или создание новой учетки социального сервиса
     *
     * @param  \Laravel\Socialite\AbstractUser $user
     *
     * @return \App\ExternalIdentity
     */
    protected function externalIdentity($user)
    {
        $identity = $this->findIdentityByUid($user->id);

        if (is_null($identity)) {
            $identity = $this->saveExternalIdentity($user);
        } else {
            $identity->touch();
        }

        return $identity;
    }

    /**
     * Поиск учетки по ID в социальном сервисе
     *
     * @param  string $uid
     *
     * @return \App\ExternalIdentity
     */
    protected function findIdentityByUid($uid)
    {
        return ExternalIdentity::where('uid', $uid)
            ->where('provider', $this->provider)
            ->first();
    }

    /**
     * Поиск пользователя сайта по электронной почте
     *
     * @param  string $email
     *
     * @return \App\User
     */
    protected function findUserByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * Мгновенная регистрация пользователя
     *
     * @param  \Laravel\Socialite\AbstractUser $user
     *
     * @return \App\User
     */
    protected function registerUser($user)
    {
        return $this->user->create([
            'email'  => $user->email,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    /**
     * Сохранение поступивших от социального сервиса данных
     *
     * @param  \Laravel\Socialite\AbstractUser $user
     *
     * @return \App\ExternalIdentity
     */
    protected function saveExternalIdentity($user)
    {
        event(new ExternalIdentitySaved($user));

        return ExternalIdentity::create([
            'provider' => $this->provider,
            'uid'      => $user->id,
            'email'    => (string) $user->email,
        ]);
    }

    /**
     * Сохранение адреса для перенаправления после входа
     *
     * @return bool
     */
    protected function saveUrlIntended()
    {
        $goto = $this->request->input('goto');

        if ($goto) {
            $this->request->session()->put('url.intended', $goto);
        }

        return true;
    }
}
