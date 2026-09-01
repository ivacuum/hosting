<?php

namespace App\Domain\Log\Action;

use App\Domain\Log\HttpFailureCategory;
use App\Domain\Log\Models\ExternalHttpRequest;

class FillExternalHttpRequestTransferStatsAction
{
    public function execute(ExternalHttpRequest $request, array $stats, bool $failed = false): void
    {
        $request->queue_time_us = $this->microseconds($stats, 'queue_time');
        $request->namelookup_time_us = $this->microseconds($stats, 'namelookup_time');
        $request->connect_time_us = $this->microseconds($stats, 'connect_time');
        $request->appconnect_time_us = $this->microseconds($stats, 'appconnect_time');
        $request->pretransfer_time_us = $this->microseconds($stats, 'pretransfer_time');
        $request->posttransfer_time_us = $this->microseconds($stats, 'posttransfer_time');
        $request->starttransfer_time_us = $this->microseconds($stats, 'starttransfer_time');
        $request->total_time_us = $this->microseconds($stats, 'total_time');
        $request->redirect_time_us = $this->microseconds($stats, 'redirect_time');
        $request->primary_ip = $stats['primary_ip'] ?? null;
        $request->primary_port = $this->nullablePort($stats['primary_port'] ?? null);
        $request->local_ip = $stats['local_ip'] ?? null;
        $request->local_port = $this->nullablePort($stats['local_port'] ?? null);
        $request->ssl_verify_result = $this->nullableInteger($stats['ssl_verify_result'] ?? $stats['ssl_verifyresult'] ?? null);
        $request->used_proxy = isset($stats['used_proxy']) ? (bool) $stats['used_proxy'] : null;
        $request->curl_errno = $this->nullableInteger($stats['errno'] ?? null);
        $request->os_errno = $this->nullableInteger($stats['os_errno'] ?? null);
        $request->curl_error = $stats['error'] ?? null;
        $request->failure_category = $failed
            ? $this->failureCategory($request->curl_errno)
            : null;
    }

    private function failureCategory(int|null $curlErrno): HttpFailureCategory
    {
        return match ($curlErrno) {
            5, 6 => HttpFailureCategory::Dns,
            7 => HttpFailureCategory::Connection,
            28 => HttpFailureCategory::Timeout,
            35, 51, 58, 60, 77, 80, 82, 83, 90, 91 => HttpFailureCategory::Tls,
            default => HttpFailureCategory::Transport,
        };
    }

    private function microseconds(array $stats, string $name): int
    {
        return (int) ($stats["{$name}_us"] ?? round(($stats[$name] ?? 0) * 1_000_000));
    }

    private function nullableInteger(mixed $value): int|null
    {
        return $value === null ? null : (int) $value;
    }

    private function nullablePort(mixed $value): int|null
    {
        $port = $this->nullableInteger($value);

        return $port !== null && $port >= 0 ? $port : null;
    }
}
