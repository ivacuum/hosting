<?php namespace App\Providers;

use App\Events\DomainWhoisUpdated;
use App\Listeners\EmailWhoisChanges;
use App\Listeners\LogUserLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DomainWhoisUpdated::class => [EmailWhoisChanges::class],
        Login::class => [LogUserLogin::class],
    ];

    public function boot()
    {
        parent::boot();

        $address = config('cfg.metrics_address');

        if ($address) {
            \Event::listen('App\Events\Stats\*', function ($name, array $data) use ($address) {
                $basename = class_basename($name);

                \MetricsHelper::push(['event' => $basename, 'data' => $data[0]]);
            });

            register_shutdown_function(function () {
                \MetricsHelper::export();
            });
        }
    }
}
