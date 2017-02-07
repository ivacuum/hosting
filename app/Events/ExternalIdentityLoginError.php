<?php namespace App\Events;

use Illuminate\Http\Request;

/**
 * Ошибка входа с помощью социальной учетки
 *
 * @property string  $provider
 * @property \Illuminate\Http\Request $request
 */
class ExternalIdentityLoginError extends Event
{
    public $request;
    public $provider;

    public function __construct($provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }
}
