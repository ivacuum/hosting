<?php namespace App\Providers;

use App\Socialite\VkProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        parent::registerPolicies();

        $this->app->singleton(VkProvider::class, function ($app) {
            $config = $app['config']['services.vk'];

            return new VkProvider(
                $app['request'],
                $config['client_id'],
                $config['client_secret'],
                $config['redirect']
            );
        });
    }
}
