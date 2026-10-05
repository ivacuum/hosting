<?php

namespace App\Console\Commands;

use App\Domain\Metrics\Action\TrimMetricsStreamAction;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:metrics:trim')]
#[Description('Trim metrics streams')]
class TrimMetricsStream extends Command
{
    public function handle(TrimMetricsStreamAction $trimMetricsStream): void
    {
        logs()->info('metrics.stream_trimmed', [
            'trimmed_entries' => $trimMetricsStream->execute(),
        ]);
    }
}
