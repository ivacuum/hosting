<?php

namespace App\Jobs;

use App\DcppHub;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\SerializesModels;

#[WithoutRelations]
class PingDcppHubJob extends AbstractJob
{
    use SerializesModels;

    public function __construct(private DcppHub $hub)
    {
    }

    public function handle()
    {
        $this->hub->is_online = $this->hub->isConnectionOnline();
        $this->hub->queried_at = now();
        $this->hub->save();
    }
}
