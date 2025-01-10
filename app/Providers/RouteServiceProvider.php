<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    #[\Override]
    public function boot()
    {
        $this->configureRateLimiting();

        \Route::pattern('id', '\d+');

        \Route::bind('CityCached', function (string $slug) {
            return \CityHelper::findBySlugOrFail($slug);
        });

        \Route::bind('CountryCached', function (string $slug) {
            return \CountryHelper::findBySlugOrFail($slug);
        });

        parent::boot();
    }

    private function configureRateLimiting()
    {
        RateLimiter::for('2fa', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->input('email') . $request->ip());
        });
    }
}
