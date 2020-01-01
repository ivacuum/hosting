<?php namespace App\Domain;

use Carbon\CarbonImmutable;

class MetricsAggregator
{
    use PingsDatabase;

    private array $metrics = [];

    public function data(): array
    {
        return $this->metrics;
    }

    public function eventClassExists(string $event): bool
    {
        try {
            new \ReflectionClass("App\Events\Stats\\$event");
            return true;
        } catch (\ReflectionException $e) {
        }

        return false;
    }

    public function export(): void
    {
        $this->pingDatabase();

        $now = CarbonImmutable::now();
        $sql = '';

        foreach ($this->metrics as $event => $count) {
            if ($count === 0) {
                continue;
            }

            $sql = sprintf(
                '%s%s("%s", "%s", %d)',
                $sql,
                ($sql ? ', ' : ''),
                $now->toDateString(),
                $event,
                $count
            );

            $this->metrics[$event] = 0;
        }

        if (!$sql) {
            return;
        }

        \DB::statement("INSERT INTO metrics (date, event, count) VALUES {$sql} ON DUPLICATE KEY UPDATE count = count + VALUES(count)");
    }

    public function push(string $event): void
    {
        if ($this->eventClassExists($event)) {
            @$this->metrics[$event]++;
        }
    }
}
