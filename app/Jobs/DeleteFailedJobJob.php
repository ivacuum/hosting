<?php

namespace App\Jobs;

use Illuminate\Queue\Attributes\Delay;

#[Delay(5)]
class DeleteFailedJobJob extends AbstractJob
{
    public function __construct(public string $uuid) {}

    public function handle()
    {
        \DB::table('failed_jobs')
            ->where('uuid', $this->uuid)
            ->delete();
    }
}
