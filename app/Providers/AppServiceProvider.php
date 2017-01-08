<?php namespace App\Providers;

use App\News;
use App\Torrent;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'news' => News::class,
            'torrent' => Torrent::class,
        ]);
    }

    public function register()
    {
        // $this->app->bind(
        //     'Illuminate\Contracts\Auth\Registrar',
        //     'App\Services\Registrar'
        // );

        /*
        \Event::listen('*', function ($event) {
            print \Event::firing() . '<br>';
        });
        */

        \Blade::directive('ru', function ($expression) {
            return '<?php if ($locale === \'ru\'): ?>';
        });

        \Blade::directive('en', function ($expression) {
            return '<?php elseif ($locale === \'en\'): ?>';
        });

        \Blade::directive('de', function ($expression) {
            return '<?php elseif ($locale === \'de\'): ?>';
        });

        \Blade::directive('endlang', function ($expression) {
            return '<?php endif; ?>';
        });

        \Blade::directive('svg', function ($expression) {
            return "<?php require base_path(\"resources/svg/$expression.html\"); ?>";
        });

        if ($this->app->environment('local')) {
            if (\Request::cookie('debugbar', false)) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if (function_exists('fastcgi_finish_request')) {
            register_shutdown_function('fastcgi_finish_request');
        }
    }
}
