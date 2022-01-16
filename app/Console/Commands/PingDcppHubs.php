<?php namespace App\Console\Commands;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use App\Jobs\PingDcppHubJob;
use Ivacuum\Generic\Commands\Command;

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
