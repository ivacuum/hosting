<?php

namespace App\Providers;

use App\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['breadcrumbs'] = $this->app->share(function($app) {
            return new Breadcrumbs($app['router']);
        });

        $this->app->alias('breadcrumbs', 'App\Breadcrumbs\Breadcrumbs');
    }
}
