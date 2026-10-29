<?php

namespace App\Domain\Log\Listener;

use App\Domain\Log\Action\FillExternalHttpRequestTransferStatsAction;
use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\Action\GetExternalServiceByHostAction;
use App\Domain\Log\Action\GetHttpBodyForLoggingAction;
use App\Domain\Log\Action\LogExternalHttpRequestDebugAction;
use App\Domain\Log\Action\RunHttpLoggingAction;
use App\Domain\Log\FailedHttpTransferStats;
use App\Domain\Log\HttpFailureCategory;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ConnectionFailed;

class LogHttpConnectionFailed
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private FailedHttpTransferStats $failedTransferStats,
        private FillExternalHttpRequestTransferStatsAction $fillTransferStats,
        private GetExternalServiceByHostAction $getExternalServiceByHost,
        private GetHttpBodyForLoggingAction $getHttpBodyForLogging,
        private LogExternalHttpRequestDebugAction $logExternalHttpRequestDebug,
        private RunHttpLoggingAction $runHttpLogging,
    ) {}

    public function handle(ConnectionFailed $event): void
    {
        if ($event->request->attributes()['skip_logging'] ?? false) {
            return;
        }

        $request = $event->request;
        $psrRequest = $request->toPsrRequest();
        $uri = $psrRequest->getUri();

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
        $model->curl_errno = $this->failedTransferStats->curlErrno($psrRequest);
        $model->failure_category = HttpFailureCategory::fromCurlErrno($model->curl_errno);

        $this->fillTransferStats->execute($model, $this->failedTransferStats->find($psrRequest)?->getHandlerStats() ?? []);
        $model->created_at = now()->subMicroseconds($model->total_time_us);

        $this->filterOutCredentials->execute($model);

        $this->runHttpLogging->execute(function () use ($model): void {
            $model->save();
            $this->logExternalHttpRequestDebug->execute($model);
        });
    }
}
