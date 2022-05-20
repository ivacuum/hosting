<?php namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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

        $this->paginatorCurrentPath($request);

        return $next($request);
    }

    private function paginatorCurrentPath(Request $request)
    {
        $locale = $request->server->get('LARAVEL_LOCALE');
        $localeUri = $locale ? "/{$locale}" : '';

        Paginator::currentPathResolver(fn () => $localeUri . $request->getBaseUrl() . $request->getPathInfo());
    }
}
