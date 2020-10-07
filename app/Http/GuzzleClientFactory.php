<?php namespace App\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class GuzzleClientFactory
{
    private $log = false;
    private $baseUri;
    private $timeout;
    private $forceIp6;
    private $serviceName;
    private $handlerStack;

    public function baseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function create(): Client
    {
        if ($this->log) {
            $config['on_stats'] = new ExternalHttpRequestTransferStatsDispatcher($this->serviceName);
        }

        if ($this->baseUri) {
            $config['base_uri'] = $this->baseUri;
        }

        if ($this->handlerStack) {
            $config['handler'] = $this->handlerStack;
        }

        if ($this->timeout) {
            $config['timeout'] = $this->timeout;
        }

        if ($this->forceIp6) {
            $config['force_ip_resolve'] = 'v6';
        }

        return new Client($config ?? []);
    }

    public function forceIp6ForProd()
    {
        $this->forceIp6 = \App::isProduction();

        return $this;
    }

    public function forTest(array $responses)
    {
        $this->handlerStack = HandlerStack::create(new MockHandler($responses));

        return $this;
    }

    public function timeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function withLog(string $serviceName): self
    {
        $this->log = true;
        $this->serviceName = $serviceName;

        return $this;
    }
}
