<?php namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, \Closure $next)
    {
        $defaultLocale = config('app.locale');
        $locale = $request->server->get('LARAVEL_LOCALE') ?? $defaultLocale;

        setlocale(LC_ALL, config("cfg.locales.{$locale}.posix"));
        setlocale(LC_NUMERIC, 'C');
        CarbonImmutable::setLocale($locale);

        if ($locale !== $defaultLocale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
