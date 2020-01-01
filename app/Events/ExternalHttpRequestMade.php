<?php namespace App\Events;

// Сделан запрос к внешнему сервису
class ExternalHttpRequestMade extends Event
{
    public string $host;
    public string $path;
    public string $query;
    public string $method;
    public string $scheme;
    public int $httpCode;
    public string $httpVersion;
    public string $redirectUrl;
    public string $requestBody;
    public string $serviceName;
    public int $totalTimeUs;
    public string $responseBody;
    public int $responseSize;
    public int $redirectCount;
    public int $redirectTimeUs;
    public string $requestHeaders;
    public string $responseHeaders;

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
