<?php namespace App\Domain\Metrics\Listener;

use App\Domain\Metrics\Action\PushMetricAction;

class WildcardMetricsListener
{
    public function __construct(private PushMetricAction $pushMetric)
    {
    }

    public function __invoke(string $eventName, array $data)
    {
        $this->pushMetric->execute([
            'event' => class_basename($eventName),
            'data' => $data[0],
        ]);
    }
}
