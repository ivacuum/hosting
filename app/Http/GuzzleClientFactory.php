<?php namespace App\Http;

use GuzzleHttp\Client;

class GuzzleClientFactory
{
    private $baseUri;
    private $timeout;

    public function baseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function createForService(string $serviceName): Client
    {
        $config['on_stats'] = new ExternalHttpRequestTransferStatsDispatcher($serviceName);

        if ($this->baseUri) {
            $config['base_uri'] = $this->baseUri;
        }

        if ($this->timeout) {
            $config['timeout'] = $this->timeout;
        }

        return new Client($config);
    }

    public function timeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }
}
