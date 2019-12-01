<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function (User $user) {
            return $user->isRoot();
        });
    }

    protected function cards()
    {
        return [
            new Help,
        ];
    }

    protected function dashboards()
    {
        return [];
    }

    public function tools()
    {
        return [];
    }

    public function register()
    {
    }
}
