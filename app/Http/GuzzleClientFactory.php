<?php

namespace App\Http;

use GuzzleHttp\Client;

class GuzzleClientFactory
{
    public function createForService(string $serviceName)
    {
        return new Client([
            'on_stats' => new ExternalHttpRequestTransferStatsDispatcher($serviceName),
        ]);
    }
}
