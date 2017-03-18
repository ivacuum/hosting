<?php namespace App\Providers;

use App\Events\DomainWhoisUpdated;
use App\Listeners\EmailWhoisChanges;
use App\Listeners\ForgetTripsCache;
use App\Listeners\LogUserLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationSent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'eloquent.saved: App\City' => [ForgetTripsCache::class],
        'eloquent.saved: App\Trip' => [ForgetTripsCache::class],

        DomainWhoisUpdated::class => [EmailWhoisChanges::class],
        Login::class => [LogUserLogin::class],
    ];

    public function boot()
    {
        parent::boot();

        if (\App::environment('local', 'production')) {
            \Event::listen('App\Events\Stats\*', function ($name, array $data) {
                $basename = class_basename($name);

                \MetricsHelper::push(['event' => $basename, 'data' => $data[0]]);
            });

            \Event::listen(NotificationSent::class, function () {
                event(new \App\Events\Stats\NotificationSent());
            });

            register_shutdown_function(function () {
                \MetricsHelper::export();
            });
        }
    }
}
