<?php

namespace App\Jobs;

use App\Domain\Dcpp\GetDcppHubInfoAction;
use App\Domain\Dcpp\Models\DcppHub;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Attributes\WithoutRelations;

#[WithoutRelations]
class PingDcppHubJob extends AbstractJob implements ShouldBeUnique
{
    public function __construct(public DcppHub $hub) {}

    public function handle(GetDcppHubInfoAction $getDcppHubInfo)
    {
        $dcppHubInfo = $getDcppHubInfo->execute($this->hub->address, $this->hub->port);

        $this->hub->is_online = $dcppHubInfo->isOnline;
        $this->hub->queried_at = now();
        $this->hub->save();
    }

    public function uniqueFor(): int
    {
        return CarbonInterval::day()->totalSeconds;
    }

    public function uniqueId()
    {
        return $this->hub->id;
    }
}
