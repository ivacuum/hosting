<?php

namespace App\Domain\Metrics\Provider;

use App\Domain\Metrics\Listener\WildcardMetricsListener;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobReleased;
use Illuminate\Queue\Events\JobReleasedAfterException;
use Illuminate\Queue\Events\JobTimedOut;
use Illuminate\Queue\Events\UniqueJobSkipped;
use Illuminate\Queue\Events\WorkerStarting;
use Illuminate\Queue\Events\WorkerStopping;
use Illuminate\Support\ServiceProvider;

class MetricsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->isLocal() || $this->app->isProduction()) {
            $this->listenForEvents();
            $this->logQueueEvents();
            $this->triggerStatsOnEvents();
        }
    }

    private function listenForEvents(): void
    {
        \Event::listen([
            'App\Events\Stats\*',
        ], WildcardMetricsListener::class);
    }

    private function logQueueEvents(): void
    {
        \Event::listen(JobExceptionOccurred::class, static function (JobExceptionOccurred $event): void {
            logs()->warning('queue.job_exception_occurred', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'uuid' => $event->job->uuid(),
                'attempts' => $event->job->attempts(),
                'exception_class' => $event->exception::class,
                'exception_message' => $event->exception->getMessage(),
            ]);
        });

        \Event::listen(JobFailed::class, static function (JobFailed $event): void {
            logs()->error('queue.job_failed', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'uuid' => $event->job->uuid(),
                'attempts' => $event->job->attempts(),
                'exception_class' => $event->exception::class,
                'exception_message' => $event->exception->getMessage(),
            ]);
        });

        \Event::listen(JobReleased::class, static function (JobReleased $event): void {
            logs()->info('queue.job_released', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'uuid' => $event->job->uuid(),
                'attempts' => $event->job->attempts(),
            ]);
        });

        \Event::listen(JobReleasedAfterException::class, static function (JobReleasedAfterException $event): void {
            logs()->warning('queue.job_released_after_exception', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'uuid' => $event->job->uuid(),
                'attempts' => $event->job->attempts(),
                'backoff' => $event->backoff,
                'exception_class' => $event->exception === null ? null : $event->exception::class,
                'exception_message' => $event->exception?->getMessage(),
            ]);
        });

        \Event::listen(JobTimedOut::class, static function (JobTimedOut $event): void {
            logs()->error('queue.job_timed_out', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'uuid' => $event->job->uuid(),
                'attempts' => $event->job->attempts(),
                'timeout' => $event->timeout,
            ]);
        });

        \Event::listen(UniqueJobSkipped::class, static function (UniqueJobSkipped $event): void {
            logs()->info('queue.unique_job_skipped', [
                'connection' => $event->job->connection ?? null,
                'queue' => $event->job->queue ?? null,
                'job' => $event->job::class,
                'unique_id' => method_exists($event->job, 'uniqueId')
                    ? $event->job->uniqueId()
                    : ($event->job->uniqueId ?? ''),
            ]);
        });

        \Event::listen(WorkerStarting::class, static function (WorkerStarting $event): void {
            logs()->info('queue.worker_starting', [
                'connection' => $event->connectionName,
                'queue' => $event->queue,
                'pid' => getmypid(),
            ]);
        });

        \Event::listen(WorkerStopping::class, static function (WorkerStopping $event): void {
            logs()->info('queue.worker_stopping', [
                'connection' => $event->connectionName,
                'queue' => $event->queue,
                'pid' => getmypid(),
                'exit_code' => $event->status,
                'reason' => $event->reason?->value,
                'jobs_processed' => $event->jobsProcessed,
                'last_job_processed_at' => $event->lastJobProcessedAt,
                'memory_usage_mb' => $event->memoryUsage,
            ]);
        });
    }

    private function triggerStatsOnEvents(): void
    {
        \Event::listen(JobProcessed::class, static function () {
            event(new \App\Events\Stats\JobProcessed);
        });

        \Event::listen(MessageSent::class, static function () {
            event(new \App\Events\Stats\MailSent);
        });

        \Event::listen(NotificationSent::class, static function () {
            event(new \App\Events\Stats\NotificationSent);
        });
    }
}
