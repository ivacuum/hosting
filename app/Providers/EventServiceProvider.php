<?php namespace App\Providers;

use App\Events\DomainWhoisUpdated;
use App\Listeners\DeletePhotoFiles;
use App\Listeners\EmailWhoisChanges;
use App\Listeners\ForgetTripsCache;
use App\Listeners\LogUserLogin;
use App\Listeners\ToggleTripPhotosStatus;
use App\Listeners\TripPhotosSlugPrefixUpdate;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Ivacuum\Generic\Providers\MetricsTrait;

class EventServiceProvider extends ServiceProvider
{
    use MetricsTrait;

    protected $listen = [
        'eloquent.saved: App\City' => [ForgetTripsCache::class],
        'eloquent.deleted: App\Photo' => [DeletePhotoFiles::class],
        'eloquent.saved: App\Trip' => [
            ToggleTripPhotosStatus::class,
            ForgetTripsCache::class
        ],
        'eloquent.updated: App\Trip' => [TripPhotosSlugPrefixUpdate::class],

        DomainWhoisUpdated::class => [EmailWhoisChanges::class],
        Login::class => [LogUserLogin::class],
    ];

    public function boot()
    {
        parent::boot();

        $this->metrics();
    }
}
