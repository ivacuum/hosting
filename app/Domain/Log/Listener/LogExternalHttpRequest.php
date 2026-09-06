<?php

namespace App\Domain\Log\Listener;

use App\Domain\Log\Action\FillExternalHttpRequestTransferStatsAction;
use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\Action\GetExternalServiceByHostAction;
use App\Domain\Log\Action\GetHttpBodyForLoggingAction;
use App\Domain\Log\Action\RunHttpLoggingAction;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Response;

class LogExternalHttpRequest
{
    public function __construct(
        private FilterOutCredentialsAction $filterOutCredentials,
        private FillExternalHttpRequestTransferStatsAction $fillTransferStats,
        private GetExternalServiceByHostAction $getExternalServiceByHost,
        private GetHttpBodyForLoggingAction $getHttpBodyForLogging,
        private RunHttpLoggingAction $runHttpLogging,
    ) {}

    public function handle(ResponseReceived $event): void
    {
        $request = $event->request;
        $response = $event->response;
        $psrRequest = $request->toPsrRequest();
        $psrResponse = $response->toPsrResponse();
        $uri = $psrRequest->getUri();
        $stats = $response->handlerStats();

        $model = new ExternalHttpRequest;
        $model->host = $uri->getHost();
        $model->path = $uri->getPath();
        $model->query = $uri->getQuery();
        $model->method = $request->method();
        $model->scheme = $uri->getScheme();
        $model->http_code = $response->status();
        $model->http_version = $stats['http_version'] ?? '';
        $model->redirect_url = $stats['redirect_url'] ?? '';
        $model->request_body = $this->getHttpBodyForLogging->execute(
            $psrRequest->getBody(),
            $psrRequest->getHeaderLine('Content-Type'),
        );
        $model->service_name = $request->attributes()['service'] ?? $this->getExternalServiceByHost->execute($uri->getHost());
        $model->response_body = $this->getHttpBodyForLogging->execute(
            $psrResponse->getBody(),
            $psrResponse->getHeaderLine('Content-Type'),
            skip: $request->attributes()['skip_response_body_logging'] ?? false,
        );
        $model->response_size = $this->responseSize($response);
        $model->redirect_count = $stats['redirect_count'] ?? 0;
        $model->request_headers = $request->headers();
        $model->response_headers = $response->headers();

        $this->fillTransferStats->execute($model, $stats);
        $model->created_at = now()->subMicroseconds($model->total_time_us);

        $this->filterOutCredentials->execute($model);

        $this->runHttpLogging->execute(fn () => $model->save());
    }

    private function responseSize(Response $response): int
    {
        $stats = $response->handlerStats();

        return max(0, (int) (
            $response->toPsrResponse()->getBody()->getSize()
            ?? $stats['size_download']
            ?? $stats['download_content_length']
            ?? 0
        ));
    }
}
