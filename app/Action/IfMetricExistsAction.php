<?php

namespace App\Action;

use App\Domain\Metrics\Models\Metric;

class IfMetricExistsAction
{
    private array $possibleMetrics;

    public function __construct()
    {
        $this->possibleMetrics = array_flip(Metric::possibleMetrics());
    }

    public function execute(string $event): bool
    {
        return isset($this->possibleMetrics[$event]);
    }
}
