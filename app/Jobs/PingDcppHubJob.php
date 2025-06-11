<?php

namespace App\Jobs;

use App\DcppHub;
use App\Domain\Dcpp\GetDcppHubInfoAction;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\SerializesModels;

#[WithoutRelations]
class PingDcppHubJob extends AbstractJob implements ShouldBeUnique
{
    use SerializesModels;

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
