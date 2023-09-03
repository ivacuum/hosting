<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::setUpdateRoute(function ($handle) {
            $locale = request()->server->get('LARAVEL_LOCALE');

            if ($locale === null) {
                return \Route::post('/livewire/update', $handle)
                    ->middleware('web');
            }

            return \Route::post("/{$locale}/livewire/update", $handle)
                ->middleware('web');
        });
    }
}
