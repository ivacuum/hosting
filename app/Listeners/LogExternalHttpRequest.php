<?php namespace App\Listeners;

use App\Events\ExternalHttpRequestMade;
use App\ExternalHttpRequest;

class LogExternalHttpRequest
{
    public function handle(ExternalHttpRequestMade $event)
    {
        if (\App::runningInConsole()) {
            $this->saveRequest($event);
        } else {
            register_shutdown_function(function () use ($event) {
                $this->saveRequest($event);
            });
        }
    }

    protected function saveRequest(ExternalHttpRequestMade $event)
    {
        ExternalHttpRequest::create([
            'host' => $event->host,
            'path' => $event->path,
            'query' => $event->query,
            'method' => $event->method,
            'scheme' => $event->scheme,
            'http_code' => $event->httpCode,
            'http_version' => $event->httpVersion,
            'redirect_url' => $event->redirectUrl,
            'request_body' => $event->requestBody,
            'service_name' => $event->serviceName,
            'response_body' => $event->responseBody,
            'response_size' => $event->responseSize,
            'total_time_us' => $event->totalTimeUs,
            'redirect_count' => $event->redirectCount,
            'request_headers' => $event->requestHeaders,
            'redirect_time_us' => $event->redirectTimeUs,
            'response_headers' => $event->responseHeaders,
        ]);
    }
}
