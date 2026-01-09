<?php

namespace App\Providers;

use App\Domain\Sphinx\SphinxPdoConnection;
use Foolz\SphinxQL\Drivers\ConnectionInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SphinxServiceProvider extends ServiceProvider implements DeferrableProvider
{
    #[\Override]
    public function register()
    {
        $this->app->scoped(ConnectionInterface::class, function () {
            $connection = new SphinxPdoConnection;
            $connection->setParams([
                'host' => config('cfg.sphinx.host'),
                'port' => config('cfg.sphinx.port'),
                ...(config('cfg.sphinx.socket') ? ['socket' => config('cfg.sphinx.socket')] : []),
            ]);

            return $connection;
        });
    }

    #[\Override]
    public function provides()
    {
        return [
            ConnectionInterface::class,
        ];
    }
}
