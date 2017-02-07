<?php namespace App\Events;

use App\ExternalIdentity;

/**
 * Не первый вход с помощью социальной учетки
 *
 * @property \App\ExternalIdentity $identity
 */
class ExternalIdentityLogin extends Event
{
    public $identity;

    public function __construct(ExternalIdentity $identity)
    {
        $this->identity = $identity;
    }
}
