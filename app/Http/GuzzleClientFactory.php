<?php namespace App\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class GuzzleClientFactory
{
    private $baseUri;
    private $timeout;
    private $handlerStack;

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

        if ($this->handlerStack) {
            $config['handler'] = $this->handlerStack;
        }

        if ($this->timeout) {
            $config['timeout'] = $this->timeout;
        }

        return new Client($config);
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
}
