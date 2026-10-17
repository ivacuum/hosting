<?php

namespace App\Http\Middleware;

use App\Domain\Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, \Closure $next): Response
    {
        $locale = $this->determineLocale($request);

        app()->setLocale($locale);

        \Context::add('locale', $locale);

        return $next($request);
    }

    private function determineLocale(Request $request): string
    {
        if ($locale = $this->prefixedLocale($request->segment(1))) {
            return $locale;
        }

        if ($request->hasHeader('X-Livewire')) {
            $firstSegment = Request::create($request->header('referer', ''))->segment(1);

            if ($locale = $this->prefixedLocale($firstSegment)) {
                return $locale;
            }
        }

        return Config::DefaultLocale->get();
    }

    private function prefixedLocale(string|null $segment): string|null
    {
        if ($segment !== null
            && $segment !== Config::DefaultLocale->get()
            && array_key_exists($segment, Config::Locales->get())) {
            return $segment;
        }

        return null;
    }
}
