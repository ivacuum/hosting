<?php

namespace App\Listeners;

use App\Action\FilterOutCredentialsAction;
use App\Action\GetExternalServiceByHostAction;
use App\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Response;

use function Illuminate\Support\defer;

class LogExternalHttpRequest
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private GetExternalServiceByHostAction $getExternalServiceByHost,
    ) {}

    public function handle(ResponseReceived $event): void
    {
        if (\App::runningInConsole()) {
            $this->saveRequest($event);

            return;
        }

        defer(fn () => $this->saveRequest($event))->always();
    }

    protected function saveRequest(ResponseReceived $event)
    {
        $request = $event->request;
        $response = $event->response;
        $uri = $request->toPsrRequest()->getUri();
        $stats = $response->handlerStats();
        $totalTimeUs = $stats['total_time_us'] ?? (($stats['total_time'] ?? 0) * 1_000_000);

        $model = new ExternalHttpRequest;
        $model->host = $uri->getHost();
        $model->path = $uri->getPath();
        $model->query = $uri->getQuery();
        $model->method = $request->method();
        $model->scheme = $uri->getScheme();
        $model->http_code = $response->status();
        $model->created_at = now()->subMicroseconds($totalTimeUs);
        $model->http_version = $stats['http_version'] ?? '';
        $model->redirect_url = $stats['redirect_url'] ?? '';
        $model->request_body = $request->body();
        $model->service_name = $this->getExternalServiceByHost->execute($uri->getHost());
        $model->response_body = $this->responseBodyInUtf8($response->body());
        $model->response_size = $this->responseSize($response);
        $model->total_time_us = $totalTimeUs;
        $model->redirect_count = $stats['redirect_count'] ?? 0;
        $model->request_headers = $request->headers();
        $model->redirect_time_us = $stats['redirect_time_us'] ?? (($stats['redirect_time'] ?? 0) * 1_000_000);
        $model->response_headers = $response->headers();

        $this->filterOutCredentials->execute($model);

        $model->save();
    }

    private function responseBodyInUtf8(string $responseBody): string
    {
        if (mb_check_encoding($responseBody) === false) {
            if (mb_check_encoding($responseBody, 'windows-1251') === true) {
                return iconv('windows-1251', 'utf-8', $responseBody);
            }

            return 'Not valid UTF-8.';
        }

        return $responseBody;
    }

    private function responseSize(Response $response)
    {
        $stats = $response->handlerStats();
        $responseSize = $stats['download_content_length'] ?? null;

        if ($responseSize >= 0) {
            return $responseSize ?? 0;
        }

        return mb_strlen($response->body());
    }
}
