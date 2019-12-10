<?php namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    public function boot(Request $request)
    {
        $defaultLocale = config('app.locale');
        $locale = $request->server->get('LARAVEL_LOCALE') ?? $defaultLocale;

        setlocale(LC_ALL, config("cfg.locales.{$locale}.posix"));
        setlocale(LC_NUMERIC, 'C');
        CarbonImmutable::setLocale($locale);

        if ($locale !== $defaultLocale) {
            $this->app->setLocale($locale);
        }
    }
}
