<?php namespace App\Jobs;

use App\DcppHub;

class PingDcppHubJob extends AbstractJob
{
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
