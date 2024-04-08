<?php

namespace App\Console\Commands;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use App\Jobs\PingDcppHubJob;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:ping-dcpp-hubs', 'Check if dc++ hubs are online')]
class PingDcppHubs extends Command
{
    protected $signature = 'app:ping-dcpp-hubs';

    public function handle()
    {
        DcppHub::query()
            ->where('status', DcppHubStatus::Published)
            ->each(function (DcppHub $hub) {
                dispatch(new PingDcppHubJob($hub));
            });
    }
}
