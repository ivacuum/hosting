<?php

namespace App\Console\Commands;

use App\Domain\Metrics\Action\TrimMetricsStreamAction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:metrics:trim')]
class TrimMetricsStream extends Command
{
    protected $signature = 'app:metrics:trim';
    protected $description = 'Trim metrics streams';

    public function handle(TrimMetricsStreamAction $trimMetricsStream)
    {
        $this->line("Entries trimmed: <info>{$trimMetricsStream->execute()}</info>");
    }
}
