<?php

namespace App\Exceptions;

use Sentry\Laravel\Integration;

class SendToSentry
{
    public function __invoke(\Throwable $e): void
    {
        Integration::captureUnhandledException($e);
    }
}
