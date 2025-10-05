<?php

namespace Tests\Feature\Metrics;

use App\Domain\Metrics\Action\FetchMetricsAction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class FetchMetricsActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        Redis::expects('client->executeRaw')
            ->with(['XREAD', 'COUNT', 999, 'STREAMS', 'vacuum:metrics', '123']);

        app(FetchMetricsAction::class)
            ->execute('123');
    }
}
