<?php

namespace Tests\Feature;

use App\Domain\Metrics\Factory\MetricFactory;
use App\Events\Stats\Build;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpMetricsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('acp/metrics')
            ->assertOk();
    }

    public function testShow()
    {
        $event = class_basename(Build::class);

        MetricFactory::new()
            ->withDate('2025-06-15')
            ->withEvent($event)
            ->withCount(7)
            ->create();

        MetricFactory::new()
            ->withDate('2025-07-01')
            ->withEvent($event)
            ->withCount(3)
            ->create();

        $this->get("acp/metrics/{$event}")
            ->assertOk()
            ->assertSee('2025')
            ->assertSee('10');
    }
}
