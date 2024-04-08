<?php

namespace App\Console\Commands;

use App\Domain\Metrics\Action\TrimMetricsStreamAction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:metrics:trim', 'Trim metrics streams')]
class TrimMetricsStream extends Command
{
    protected $signature = 'app:metrics:trim';

    public function handle(TrimMetricsStreamAction $trimMetricsStream)
    {
        $this->line("Entries trimmed: <info>{$trimMetricsStream->execute()}</info>");
    }
}
