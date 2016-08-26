<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        // $this->app->bind(
        //     'Illuminate\Contracts\Auth\Registrar',
        //     'App\Services\Registrar'
        // );

        /*
        \Event::listen('*', function ($event) {
            print \Event::firing() . '<br>';
        });
        */

        if ($this->app->environment('local')) {
            if (\Request::cookie('debugbar', false)) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if (function_exists('fastcgi_finish_request')) {
            register_shutdown_function('fastcgi_finish_request');
        }
    }
}
