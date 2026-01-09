<?php

namespace App\Providers;

use App\Domain\Sphinx\SphinxScoutEngine;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class ScoutServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make(EngineManager::class)
            ->extend('sphinx', fn () => $this->app->make(SphinxScoutEngine::class));
    }
}
