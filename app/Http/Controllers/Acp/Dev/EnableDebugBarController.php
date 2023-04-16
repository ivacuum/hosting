<?php namespace App\Http\Controllers\Acp\Dev;

use Illuminate\Cookie\CookieJar;

class EnableDebugBarController
{
    public function __invoke(CookieJar $cookie)
    {
        $cookie->queue('debugbar', true, 60);

        return redirect(to('acp/dev'))
            ->with('message', 'Debugbar включен на час');
    }
}
