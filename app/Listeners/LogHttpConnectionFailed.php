<?php namespace App\Listeners;

use App\Action\FilterOutCredentialsAction;
use App\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ConnectionFailed;

class LogHttpConnectionFailed
{
    public function __construct(private FilterOutCredentialsAction $filterOutCredentials)
    {
    }

    public function handle(ConnectionFailed $event)
    {
        if (\App::runningInConsole()) {
            $this->saveRequest($event);

            return;
        }

        register_shutdown_function(function () use ($event) {
            $this->saveRequest($event);
        });
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
        $model->service_name = $this->serviceName($uri->getHost());
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
