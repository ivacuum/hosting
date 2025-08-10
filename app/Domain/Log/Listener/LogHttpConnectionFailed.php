<?php

namespace App\Domain\Log\Listener;

use App\Action\GetExternalServiceByHostAction;
use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ConnectionFailed;

use function Illuminate\Support\defer;

class LogHttpConnectionFailed
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private GetExternalServiceByHostAction $getExternalServiceByHost,
    ) {}

    public function handle(ConnectionFailed $event): void
    {
        if (\App::runningInConsole()) {
            $this->saveRequest($event);

            return;
        }

        defer(fn () => $this->saveRequest($event))->always();
    }

    protected function saveRequest(ConnectionFailed $event)
    {
        $request = $event->request;
        $uri = $request->toPsrRequest()->getUri();

        $model = new ExternalHttpRequest;
        $model->host = $uri->getHost();
        $model->path = $uri->getPath();
        $model->query = $uri->getQuery();
        $model->method = $request->toPsrRequest()->getMethod();
        $model->scheme = $uri->getScheme();
        $model->http_code = 408;
        $model->http_version = '';
        $model->redirect_url = '';
        $model->request_body = $request->body();
        $model->service_name = $this->getExternalServiceByHost->execute($uri->getHost());
        $model->response_body = '';
        $model->response_size = 0;
        $model->total_time_us = 0;
        $model->redirect_count = 0;
        $model->request_headers = $request->toPsrRequest()->getHeaders();
        $model->redirect_time_us = 0;
        $model->response_headers = '';

        $this->filterOutCredentials->execute($model);

        $model->save();
    }
}
