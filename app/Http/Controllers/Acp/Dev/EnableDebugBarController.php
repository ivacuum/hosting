<?php

namespace App\Http\Controllers\Acp\Dev;

use App\Domain\SessionKey;
use Illuminate\Cookie\CookieJar;

class EnableDebugBarController
{
    public function __invoke(CookieJar $cookie)
    {
        $cookie->queue('debugbar', true, 60);

        return redirect(to('acp/dev'))
            ->with(SessionKey::FlashMessage->value, 'Debugbar включен на час');
    }
}
