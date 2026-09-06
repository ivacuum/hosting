<?php

namespace App\Domain\Log\Listener;

use App\Domain\Log\Action\FillExternalHttpRequestTransferStatsAction;
use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\Action\GetExternalServiceByHostAction;
use App\Domain\Log\Action\GetHttpBodyForLoggingAction;
use App\Domain\Log\Action\RunHttpLoggingAction;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ConnectionFailed;

class LogHttpConnectionFailed
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private FillExternalHttpRequestTransferStatsAction $fillTransferStats,
        private GetExternalServiceByHostAction $getExternalServiceByHost,
        private GetHttpBodyForLoggingAction $getHttpBodyForLogging,
        private RunHttpLoggingAction $runHttpLogging,
    ) {}

    public function handle(ConnectionFailed $event): void
    {
        $request = $event->request;
        $psrRequest = $request->toPsrRequest();
        $uri = $psrRequest->getUri();
        $previous = $event->exception->getPrevious();
        $stats = method_exists($previous, 'getHandlerContext')
            ? $previous->getHandlerContext()
            : [];

        $model = new ExternalHttpRequest;
        $model->host = $uri->getHost();
        $model->path = $uri->getPath();
        $model->query = $uri->getQuery();
        $model->method = $psrRequest->getMethod();
        $model->scheme = $uri->getScheme();
        $model->http_code = null;
        $model->http_version = '';
        $model->redirect_url = '';
        $model->request_body = $this->getHttpBodyForLogging->execute(
            $psrRequest->getBody(),
            $psrRequest->getHeaderLine('Content-Type'),
        );
        $model->service_name = $request->attributes()['service'] ?? $this->getExternalServiceByHost->execute($uri->getHost());
        $model->response_body = '';
        $model->response_size = 0;
        $model->redirect_count = 0;
        $model->request_headers = $psrRequest->getHeaders();
        $model->response_headers = '';

        $this->fillTransferStats->execute($model, $stats, failed: true);
        $model->created_at = now()->subMicroseconds($model->total_time_us);

        $this->filterOutCredentials->execute($model);

        $this->runHttpLogging->execute(fn () => $model->save());
    }
}
