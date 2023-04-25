<?php namespace App\Providers;

use App\Http\Middleware\AcpNavigation;
use App\Http\Middleware\Admin;
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

        \Route::bind('CityCached', function (string $slug) {
            return \CityHelper::findBySlugOrFail($slug);
        });

        \Route::bind('CountryCached', function (string $slug) {
            return \CountryHelper::findBySlugOrFail($slug);
        });

        parent::boot();
    }

    public function map()
    {
        \Route::prefix('')
            ->group(base_path('routes/simple.php'));

        \Route::middleware(['web', 'auth', Admin::class, AcpNavigation::class])
            ->prefix('acp')
            ->name('acp.')
            ->group(base_path('routes/acp.php'));

        \Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    private function configureRateLimiting()
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
