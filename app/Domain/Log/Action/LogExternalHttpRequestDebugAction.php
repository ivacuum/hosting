<?php

namespace App\Domain\Log\Action;

use App\Domain\Log\Models\ExternalHttpRequest;

class LogExternalHttpRequestDebugAction
{
    public function execute(ExternalHttpRequest $request): void
    {
        logs()->debug('http.external_request', [
            'id' => $request->id,
            'service' => $request->service_name->value,
            'method' => $request->method,
            'host' => $request->host,
            'path' => $request->path,
            'http_code' => $request->http_code,
            'duration' => $request->total_time_us / 1_000_000,
        ]);
    }
}
