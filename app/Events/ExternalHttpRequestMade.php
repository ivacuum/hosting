<?php namespace App\Events;

// Сделан запрос к внешнему сервису
class ExternalHttpRequestMade extends Event
{
    public int $httpCode;
    public int $totalTimeUs;
    public int $responseSize;
    public int $redirectCount;
    public int $redirectTimeUs;
    public array $requestHeaders;
    public array $responseHeaders;
    public string $host;
    public string $path;
    public string $query;
    public string $method;
    public string $scheme;
    public string $httpVersion;
    public string $redirectUrl;
    public string $requestBody;
    public string $serviceName;
    public string $responseBody;

    public function __construct(
        string $serviceName,
        string $method,
        string $scheme,
        string $host,
        string $path,
        string $query,
        array $requestHeaders,
        string $requestBody,
        array $responseHeaders,
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
