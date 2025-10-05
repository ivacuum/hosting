<?php

namespace App\Console\Commands;

use App\Domain\Dcpp\DcppHubStatus;
use App\Domain\Dcpp\Models\DcppHub;
use App\Jobs\PingDcppHubJob;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:ping-dcpp-hubs')]
class PingDcppHubs extends Command
{
    protected $signature = 'app:ping-dcpp-hubs';
    protected $description = 'Check if dc++ hubs are online';

    public function handle()
    {
        DcppHub::query()
            ->where('status', DcppHubStatus::Published)
            ->each(function (DcppHub $hub) {
                dispatch(new PingDcppHubJob($hub));
            });
    }
}
