<?php

namespace App\Providers;

use App\Socialite\VkProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var \Laravel\Socialite\SocialiteManager $socialite */
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('vk', function () use ($socialite) {
            return $socialite->buildProvider(VkProvider::class, config('services.vk'));
        });
    }
}
