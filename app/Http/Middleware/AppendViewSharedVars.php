<?php

namespace App\Http\Middleware;

use App\Domain\Blade\Action\AppendViewSharedVarsAction;
use App\Domain\Config;
use Illuminate\Http\Request;

class AppendViewSharedVars
{
    public function __construct(private AppendViewSharedVarsAction $appendViewSharedVars) {}

    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isMethod('GET') && !$request->isMethod('HEAD') && !$this->isLivewireRequest($request)) {
            return $next($request);
        }

        if ($this->isLivewireRequest($request)) {
            $this->setLocaleFromReferrer($request);
        }

        $this->appendViewSharedVars->execute($request);

        return $next($request);
    }

    private function isLivewireRequest(Request $request): bool
    {
        return $request->hasHeader('X-Livewire');
    }

    private function setLocaleFromReferrer(Request $request)
    {
        $referrer = $request->headers->get('referer');

        if (!$referrer) {
            return;
        }

        $locale = Request::create($referrer)->segment(1);
        $locales = Config::Locales->get();
        $defaultLocale = config('app.locale');

        if (is_array($locales) && in_array($locale, array_keys($locales)) && $locale !== $defaultLocale) {
            $request->server->set('LARAVEL_LOCALE', $locale);
        }
    }
}
