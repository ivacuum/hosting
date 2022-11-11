<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Livewire\Response;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->appendLocaleToLivewireBrowserHistory();
        $this->appendLocaleToLivewireComponentView();
    }

    private function appendLocaleToLivewireBrowserHistory()
    {
        \Livewire::listen('component.dehydrate.initial', function ($component, Response $response) {
            if (empty($response->effects['path'])) {
                return;
            }

            $locale = request()->server->get('LARAVEL_LOCALE');

            if ($locale === null) {
                return;
            }

            $path = parse_url($response->effects['path'], PHP_URL_PATH);

            if (str_starts_with($path, "/{$locale}/")) {
                return;
            }

            $response->effects['path'] = str_replace(url('/'), url('/') . "/{$locale}", $response->effects['path']);
        });
    }

    private function appendLocaleToLivewireComponentView()
    {
        \Livewire::listen('component.rendered', function ($component, View $view) {
            $view->with('locale', request()->server->get('LARAVEL_LOCALE') ?: config('app.locale'));
        });
    }
}
