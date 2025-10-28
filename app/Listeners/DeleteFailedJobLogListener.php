<?php

namespace App\Listeners;

use App\Attributes\WithoutFailedJobLog;
use App\Jobs\DeleteFailedJobJob;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Queue\Events\JobFailed;

class DeleteFailedJobLogListener
{
    public function handle(JobFailed $event)
    {
        if ($event->job->isDeleted()) {
            $appClass = $this->isSendNotificationJob($event->job)
                ? $event->job->resolveName()
                : $event->job->resolveQueuedJobClass();

            $reflectionClass = new \ReflectionClass($appClass);

            if (!empty($reflectionClass->getAttributes(WithoutFailedJobLog::class))) {
                dispatch(new DeleteFailedJobJob($event->job->uuid()))
                    ->delay(now()->addSeconds(5));
            }
        }
    }

    private function isSendNotificationJob(Job $job): bool
    {
        return $job->resolveQueuedJobClass() === SendQueuedNotifications::class;
    }
}
