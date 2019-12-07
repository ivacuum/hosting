<?php namespace App\Providers;

use App\Nova\Metrics;
use App\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
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
            new Metrics\HiraganaAnsweredTrend,
            new Metrics\KatakanaAnsweredTrend,
            new Metrics\TorrentClicksTrend,
            new Metrics\TorrentViewsTrend,
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
}
