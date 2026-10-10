<?php

namespace App\Domain\Metrics\Factory;

use App\Domain\Metrics\Models\Metric;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class MetricFactory
{
    private int $count = 1;
    private string|null $event = null;
    private CarbonImmutable|null $date = null;

    public function create(): Metric
    {
        $metric = $this->make();
        $metric->save();

        return $metric;
    }

    public function make(): Metric
    {
        $metric = new Metric;
        $metric->date = $this->date ?? today();
        $metric->event = $this->event ?? 'phpunit-' . fake()->uuid();
        $metric->count = $this->count;

        return $metric;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCount(int $count): self
    {
        return clone ($this, ['count' => $count]);
    }

    #[\NoDiscard]
    public function withDate(CarbonInterface|string $date): self
    {
        return clone ($this, ['date' => CarbonImmutable::make($date)]);
    }

    #[\NoDiscard]
    public function withEvent(string $event): self
    {
        return clone ($this, ['event' => $event]);
    }
}
