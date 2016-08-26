<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->booted(function($app) {
            $app['validator']->extend('empty', function ($attr, $value, $params) {
                return empty($value);
            }, 'Читер');
        });
    }
}
