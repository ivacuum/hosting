<?php namespace App\Domain\Metrics\Provider;

use App\Domain\Metrics\Action\PushMetricAction;
use App\Domain\Metrics\Listener\WildcardMetricsListener;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\WorkerStopping;
use Illuminate\Support\ServiceProvider;

class MetricsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->scoped(PushMetricAction::class);

        if ($this->app->isLocal() || $this->app->isProduction()) {
            $this->listenForEvents();
            $this->triggerStatsOnEvents();
        }
    }

    private function listenForEvents(): void
    {
        \Event::listen([
            'App\Events\Stats\*',
            'Ivacuum\Generic\Events\Stats\*',
        ], WildcardMetricsListener::class);
    }

    private function triggerStatsOnEvents(): void
    {
        \Event::listen(JobProcessed::class, function () {
            event(new \Ivacuum\Generic\Events\Stats\JobProcessed);
        });

        \Event::listen(MessageSent::class, function () {
            event(new \Ivacuum\Generic\Events\Stats\MailSent);
        });

        \Event::listen(NotificationSent::class, function () {
            event(new \Ivacuum\Generic\Events\Stats\NotificationSent);
        });

        \Event::listen(WorkerStopping::class, function () {
            \Log::info("Worker is stopping...\n");
        });
    }
}
