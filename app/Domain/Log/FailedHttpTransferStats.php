<?php

namespace App\Domain\Log;

use GuzzleHttp\TransferStats;
use Illuminate\Container\Attributes\Scoped;
use Psr\Http\Message\RequestInterface;

/**
 * С Guzzle 8 вынуждены сами сохранять инфу об ошибках соединений
 */
#[Scoped]
class FailedHttpTransferStats
{
    /** @var \WeakMap<RequestInterface, TransferStats> */
    private \WeakMap $stats;

    public function __construct()
    {
        $this->stats = new \WeakMap;
    }

    public function curlErrno(RequestInterface $request): int|null
    {
        $errorData = $this->find($request)?->getHandlerErrorData();

        return is_int($errorData) ? $errorData : null;
    }

    public function find(RequestInterface $request): TransferStats|null
    {
        return $this->stats[$request] ?? null;
    }

    public function remember(TransferStats $stats): void
    {
        if ($stats->getResponse() !== null) {
            return;
        }

        $this->stats[$stats->getRequest()] = $stats;
    }
}
