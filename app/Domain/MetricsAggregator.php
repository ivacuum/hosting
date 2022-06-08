<?php namespace App\Domain;

use App\Action\IfMetricExistsAction;

class MetricsAggregator
{
    /** @var array<string, int> */
    private array $metrics = [];

    public function __construct(private IfMetricExistsAction $ifMetricExists)
    {
    }

    public function data(): array
    {
        return $this->metrics;
    }

    public function export(): void
    {
        $now = now();
        $values = '';

        foreach ($this->metrics as $event => $count) {
            if ($count === 0) {
                continue;
            }

            $values = sprintf(
                '%s%s("%s", "%s", %d)',
                $values,
                ($values ? ', ' : ''),
                $now->toDateString(),
                $event,
                $count
            );

            $this->metrics[$event] = 0;
        }

        if (!$values) {
            return;
        }

        \DB::statement("INSERT INTO metrics (date, event, count) VALUES {$values} ON DUPLICATE KEY UPDATE count = count + VALUES(count)");
    }

    public function push(string $event): void
    {
        if ($this->ifMetricExists->execute($event)) {
            @$this->metrics[$event]++;
        }
    }
}
