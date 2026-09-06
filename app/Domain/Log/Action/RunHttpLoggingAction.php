<?php

namespace App\Domain\Log\Action;

use function Illuminate\Support\defer;

class RunHttpLoggingAction
{
    public function execute(callable $callback): void
    {
        $log = fn () => rescue(
            $callback,
            rescue: fn (\Throwable $e) => config('app.debug')
                ? throw $e
                : null,
        );

        if (\App::runningInConsole() || config('app.debug')) {
            $log();

            return;
        }

        defer($log)->always();
    }
}
