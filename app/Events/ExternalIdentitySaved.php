<?php namespace App\Events;

/**
 * Данные социальной учетки сохранены впервые
 *
 * @property \Laravel\Socialite\AbstractUser $user
 */
class ExternalIdentitySaved extends Event
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
