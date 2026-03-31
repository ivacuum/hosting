<?php

namespace App\Console\Commands;

use App\Domain\Dcpp\DcppHubStatus;
use App\Domain\Dcpp\Models\DcppHub;
use App\Jobs\PingDcppHubJob;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('app:ping-dcpp-hubs')]
#[Description('Check if dc++ hubs are online')]
class PingDcppHubs extends Command
{
    public function handle()
    {
        DcppHub::query()
            ->where('status', DcppHubStatus::Published)
            ->each(function (DcppHub $hub) {
                dispatch(new PingDcppHubJob($hub));
            });
    }
}
