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
        if (mb_check_encoding($event->responseBody) === false) {
            if (mb_check_encoding($event->responseBody, 'windows-1251') === true) {
                $event->responseBody = iconv('windows-1251', 'utf-8', $event->responseBody);
            } else {
                $event->responseBody = 'Not valid UTF-8.';
            }
        }

        $model = new ExternalHttpRequest;
        $model->host = $event->host;
        $model->path = $event->path;
        $model->query = $event->query;
        $model->method = $event->method;
        $model->scheme = $event->scheme;
        $model->http_code = $event->httpCode;
        $model->created_at = now()->subMicroseconds($event->totalTimeUs);
        $model->http_version = $event->httpVersion;
        $model->redirect_url = $event->redirectUrl;
        $model->request_body = $event->requestBody;
        $model->service_name = $event->serviceName;
        $model->response_body = $event->responseBody;
        $model->response_size = $event->responseSize;
        $model->total_time_us = $event->totalTimeUs;
        $model->redirect_count = $event->redirectCount;
        $model->request_headers = $event->requestHeaders;
        $model->redirect_time_us = $event->redirectTimeUs;
        $model->response_headers = $event->responseHeaders;
        $model->save();
    }
}
