<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        setlocale(LC_ALL, config('app.setlocale'));

        Carbon::setLocale('ru');

        // $this->app->bind(
        //     'Illuminate\Contracts\Auth\Registrar',
        //     'App\Services\Registrar'
        // );

        if ($this->app->environment('local')) {
            if (\Input::cookie('debugbar', false)) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if (function_exists('fastcgi_finish_request')) {
            register_shutdown_function('fastcgi_finish_request');
        }
    }
}
