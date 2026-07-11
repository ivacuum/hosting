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

        \Route::bind('CityCached', static function (string $slug) {
            return \CityHelper::findBySlugOrFail($slug);
        });

        \Route::bind('CountryCached', static function (string $slug) {
            return \CountryHelper::findBySlugOrFail($slug);
        });

        parent::boot();
    }

    private function configureRateLimiting()
    {
        RateLimiter::for('2fa', static function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', static function (Request $request) {
            return [
                Limit::perMinute(5)->by($request->input('email')),
                Limit::perMinute(10)->by($request->ip()),
            ];
        });

        RateLimiter::for('magnet-request', static function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('mcp', static function (Request $request) {
            return Limit::perMinute(60)->by($request->bearerToken() ?? $request->ip());
        });

        RateLimiter::for('password-remind', static function (Request $request) {
            return [
                Limit::perMinute(3)->by($request->input('email')),
                Limit::perMinute(5)->by($request->ip()),
            ];
        });

        RateLimiter::for('password-reset', static function (Request $request) {
            return [
                Limit::perMinute(3)->by($request->input('email')),
                Limit::perMinute(5)->by($request->ip()),
            ];
        });

        RateLimiter::for('register', static function (Request $request) {
            return [
                Limit::perMinute(5)->by($request->ip()),
                Limit::perMinute(5)->by($request->input('email')),
            ];
        });

        RateLimiter::for('subscription', static function (Request $request) {
            return [
                Limit::perMinute(3)->by($request->ip()),
                Limit::perMinute(3)->by($request->input('email')),
            ];
        });

        RateLimiter::for('typo', static function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('upload', static function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });
    }
}
