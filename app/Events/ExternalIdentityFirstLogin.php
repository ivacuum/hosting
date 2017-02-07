<?php namespace App\Events;

use App\ExternalIdentity;
use App\User;

/**
 * Первый вход с помощью социальной учетки
 *
 * @property \App\ExternalIdentity $identity
 * @property \App\User             $user
 */
class ExternalIdentityFirstLogin extends Event
{
    public $user;
    public $identity;

    public function __construct(ExternalIdentity $identity, User $user)
    {
        $this->user = $user;
        $this->identity = $identity;
    }
}
