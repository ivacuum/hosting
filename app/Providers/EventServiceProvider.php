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
    }
}
