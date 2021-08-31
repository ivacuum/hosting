<?php namespace App\Listeners;

use App\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Response;

class LogExternalHttpRequest
{
    public function handle(ResponseReceived $event)
    {
        if (\App::runningInConsole()) {
            $this->saveRequest($event);
        } else {
            register_shutdown_function(function () use ($event) {
                $this->saveRequest($event);
            });
        }
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
        $model->method = $request->toPsrRequest()->getMethod();
        $model->scheme = $uri->getScheme();
        $model->http_code = $response->status();
        $model->created_at = now()->subMicroseconds($totalTimeUs);
        $model->http_version = $stats['http_version'] ?? '';
        $model->redirect_url = $stats['redirect_url'] ?? '';
        $model->request_body = $request->body();
        $model->service_name = $this->serviceName($uri->getHost());
        $model->response_body = $this->responseBodyInUtf8($response->body());
        $model->response_size = $this->responseSize($response);
        $model->total_time_us = $totalTimeUs;
        $model->redirect_count = $stats['redirect_count'] ?? 0;
        $model->request_headers = $request->toPsrRequest()->getHeaders();
        $model->redirect_time_us = $stats['redirect_time_us'] ?? (($stats['redirect_time'] ?? 0) * 1_000_000);
        $model->response_headers = $response->toPsrResponse()->getHeaders();
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

    private function serviceName(string $host): string
    {
        return match ($host) {
            'api.vk.com' => 'vk',
            'api.telegram.org' => 'telegram',
            'api.wanikani.com' => 'wanikani',
            'pddimp.yandex.ru' => 'yandex',
            'api.rutracker.org', 'rutracker.org' => 'rto',
            default => '',
        };
    }
}
