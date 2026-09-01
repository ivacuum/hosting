<?php

namespace App\Domain\Log\Listener;

use App\Domain\Log\Action\FillExternalHttpRequestTransferStatsAction;
use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\Action\GetExternalServiceByHostAction;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ConnectionFailed;

use function Illuminate\Support\defer;

class LogHttpConnectionFailed
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private FillExternalHttpRequestTransferStatsAction $fillTransferStats,
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
        $previous = $event->exception->getPrevious();
        $stats = method_exists($previous, 'getHandlerContext')
            ? $previous->getHandlerContext()
            : [];

        $model = new ExternalHttpRequest;
        $model->host = $uri->getHost();
        $model->path = $uri->getPath();
        $model->query = $uri->getQuery();
        $model->method = $request->toPsrRequest()->getMethod();
        $model->scheme = $uri->getScheme();
        $model->http_code = null;
        $model->http_version = '';
        $model->redirect_url = '';
        $model->request_body = $request->body();
        $model->service_name = $this->getExternalServiceByHost->execute($uri->getHost());
        $model->response_body = '';
        $model->response_size = 0;
        $model->redirect_count = 0;
        $model->request_headers = $request->toPsrRequest()->getHeaders();
        $model->response_headers = '';

        $this->fillTransferStats->execute($model, $stats, failed: true);
        $model->created_at = now()->subMicroseconds($model->total_time_us);

        $this->filterOutCredentials->execute($model);

        $model->save();
    }
}
