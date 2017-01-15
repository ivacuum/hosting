<?php namespace App\Providers;

use App\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Breadcrumbs::class, function () {
            return new Breadcrumbs();
        });
    }
}
