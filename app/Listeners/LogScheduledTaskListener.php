<?php

namespace App\Listeners;

use Illuminate\Console\Application;
use Illuminate\Console\Events\ScheduledBackgroundTaskFinished;
use Illuminate\Console\Events\ScheduledTaskFailed;
use Illuminate\Console\Events\ScheduledTaskFinished;
use Illuminate\Console\Events\ScheduledTaskSkipped;
use Illuminate\Console\Events\ScheduledTaskStarting;

class LogScheduledTaskListener
{
    public function handle(
        ScheduledTaskStarting|ScheduledTaskFinished|ScheduledBackgroundTaskFinished|ScheduledTaskSkipped|ScheduledTaskFailed $event,
    ): void {
        $task = $event->task;

        $status = match (true) {
            $event instanceof ScheduledTaskStarting => 'starting',
            $event instanceof ScheduledTaskSkipped => 'skipped',
            $event instanceof ScheduledTaskFinished && $task->skippedBecauseOverlapping => 'skipped_overlapping',
            $event instanceof ScheduledTaskFinished && $task->runInBackground => 'starting_background',
            $event instanceof ScheduledTaskFinished,
            $task->exitCode === 0 => 'finished',
            default => 'failed',
        };

        $context = [
            'command' => $task->command === null
                ? $task->getSummaryForDisplay()
                : str($task->command)->chopStart(Application::formatCommandString(''))->toString(),
        ];

        if ($status === 'finished' || $status === 'failed') {
            $context['exit_code'] = $task->exitCode;
        }

        if ($event instanceof ScheduledTaskFinished && !$task->runInBackground && !$task->skippedBecauseOverlapping) {
            $context['duration_seconds'] = $event->runtime;
        }

        if ($event instanceof ScheduledTaskFailed) {
            $context['exception_class'] = $event->exception::class;
            $context['exception_message'] = $event->exception->getMessage();
        }

        logs()->log($status === 'failed' ? 'error' : 'info', "scheduler.task_{$status}", $context);
    }
}
