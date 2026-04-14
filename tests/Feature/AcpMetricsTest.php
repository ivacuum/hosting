<?php

namespace Tests\Feature;

use App\Domain\Metrics\Models\Metric;
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

        $metric = new Metric;
        $metric->date = '2025-06-15';
        $metric->event = $event;
        $metric->count = 7;
        $metric->save();

        $metric = new Metric;
        $metric->date = '2025-07-01';
        $metric->event = $event;
        $metric->count = 3;
        $metric->save();

        $this->get("acp/metrics/{$event}")
            ->assertOk()
            ->assertSee('2025')
            ->assertSee('10');
    }
}
