<?php

namespace App\Domain\Log\Action;

use App\Domain\Log\Models\ExternalHttpRequest;

class FillExternalHttpRequestTransferStatsAction
{
    public function execute(ExternalHttpRequest $request, array $stats): void
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
        $request->ssl_verify_result = $this->nullableInteger($stats['ssl_verify_result'] ?? null);
        $request->used_proxy = isset($stats['used_proxy']) ? (bool) $stats['used_proxy'] : null;
    }

    private function microseconds(array $stats, string $name): int
    {
        return (int) ($stats["{$name}_us"] ?? 0);
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
