<?php

namespace App\Providers;

use App\Socialite\VkProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot()
    {
        /** @var \Laravel\Socialite\SocialiteManager $socialite */
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('vk', function () use ($socialite) {
            return $socialite->buildProvider(VkProvider::class, config('services.vk'));
        });
    }

    #[\Override]
    public function register()
    {
        $this->app->scoped(VkProvider::class, function ($app) {
            return new VkProvider(
                $app['request'],
                config('services.vk.client_id'),
                config('services.vk.client_secret'),
                config('services.vk.redirect')
            );
        });
    }

    #[\Override]
    public function provides()
    {
        return [VkProvider::class];
    }
}
