<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DebugbarServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register()
    {
        if (!$this->app->isLocal()) {
            return;
        }

        if (!request()->cookie('debugbar', false)) {
            return;
        }

        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
    }
}
