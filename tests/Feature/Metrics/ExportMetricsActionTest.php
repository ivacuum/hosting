<?php

namespace Tests\Feature\Metrics;

use App\Domain\Metrics\Listener\WildcardMetricsListener;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class ExportMetricsActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        Redis::expects('client->executeRaw')
            ->with(['XADD', 'vacuum:metrics', '*', 'json', '[{"event":"TripViewed","data":{"table":"trips","id":1}}]']);

        // Redis::expects('xadd')
        //     ->with('vacuum:metrics', [
        //         'json' => '[{"event":"TripViewed","data":{"table":"trips","id":1}}]',
        //     ]);

        $event = new \App\Events\Stats\TripViewed(id: 1);

        \Event::listen(['App\Events\Stats\*'], WildcardMetricsListener::class);

        event($event);
    }
}
