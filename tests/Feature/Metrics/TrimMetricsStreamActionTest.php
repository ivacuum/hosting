<?php

namespace Tests\Feature\Metrics;

use App\Domain\Metrics\Action\TrimMetricsStreamAction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class TrimMetricsStreamActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        Redis::expects('client->executeRaw')
            ->with(['XTRIM', 'vacuum:metrics', 'MAXLEN', '~', '5000'])
            ->andReturn(0);

        app(TrimMetricsStreamAction::class)
            ->execute();
    }
}
