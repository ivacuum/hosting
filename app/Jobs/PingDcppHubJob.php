<?php

namespace App\Jobs;

use App\DcppHub;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\SerializesModels;

#[WithoutRelations]
class PingDcppHubJob extends AbstractJob implements ShouldBeUnique
{
    use SerializesModels;

    public function __construct(public DcppHub $hub) {}

    public function handle()
    {
        $this->hub->is_online = $this->hub->isConnectionOnline();
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
