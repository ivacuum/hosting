<?php

namespace App\Jobs;

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
