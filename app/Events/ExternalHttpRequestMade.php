<?php namespace App\Events;

// Сделан запрос к внешнему сервису
class ExternalHttpRequestMade extends Event
{
    public $host;
    public $path;
    public $query;
    public $method;
    public $scheme;
    public $httpCode;
    public $httpVersion;
    public $redirectUrl;
    public $requestBody;
    public $serviceName;
    public $totalTimeUs;
    public $responseBody;
    public $responseSize;
    public $redirectCount;
    public $redirectTimeUs;
    public $requestHeaders;
    public $responseHeaders;

    public function __construct(
        string $serviceName,
        string $method,
        string $scheme,
        string $host,
        string $path,
        string $query,
        string $requestHeaders,
        string $requestBody,
        string $responseHeaders,
        string $responseBody,
        int $responseSize,
        int $totalTimeUs,
        int $httpCode,
        string $httpVersion,
        int $redirectCount,
        int $redirectTimeUs,
        string $redirectUrl
    ) {
        $this->host = $host;
        $this->path = $path;
        $this->query = $query;
        $this->method = $method;
        $this->scheme = $scheme;
        $this->httpCode = $httpCode;
        $this->httpVersion = $httpVersion;
        $this->redirectUrl = $redirectUrl;
        $this->requestBody = $requestBody;
        $this->serviceName = $serviceName;
        $this->totalTimeUs = $totalTimeUs;
        $this->responseBody = $responseBody;
        $this->responseSize = $responseSize;
        $this->redirectCount = $redirectCount;
        $this->redirectTimeUs = $redirectTimeUs;
        $this->requestHeaders = $requestHeaders;
        $this->responseHeaders = $responseHeaders;
    }
}
