<?php namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureRateLimiting();

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

    protected function configureRateLimiting()
    {
        RateLimiter::for('2fa', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->input('email') . $request->ip());
        });
    }
}
