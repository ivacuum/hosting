<?php

namespace App\Http\Middleware;

use App\Domain\Config;
use App\Domain\Locale;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, \Closure $next)
    {
        $locale = $this->determineLocale($request);

        app()->setLocale($locale);

        return $next($request);
    }

    private function determineLocale(Request $request): string
    {
        if ($request->segment(1) === Locale::Eng->value) {
            return Locale::Eng->value;
        } elseif ($request->hasHeader('X-Livewire')) {
            $referrer = $request->header('referer');

            if ($referrer) {
                $firstSegment = Request::create($referrer)->segment(1);

                if ($firstSegment === Locale::Eng->value) {
                    return Locale::Eng->value;
                }
            }
        }

        return Config::DefaultLocale->get();
    }
}
