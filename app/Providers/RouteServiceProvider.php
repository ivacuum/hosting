<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Route::pattern('id', '\d+');

        parent::boot();
    }

    public function map()
    {
        \Route::prefix('')
            ->group(base_path('routes/simple.php'));

        \Route::middleware(['web', 'auth', 'admin'])
            ->prefix('acp')
            ->group(base_path('routes/acp.php'));

        \Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
