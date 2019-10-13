<?php namespace Tests\Unit;

use App\Domain\MetricsAggregator;
use App\Domain\MetricsParser;
use App\Domain\ViewsAggregator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MetricsParserTest extends TestCase
{
    use DatabaseTransactions;

    public function testParsePayload()
    {
        $event1 = 'PayloadEvent1';
        $event2 = 'PayloadEvent1Viewed';

        $viewsAggregator = \Mockery::mock(ViewsAggregator::class);
        $viewsAggregator->shouldReceive('push')->once();

        $metricsAggregator = \Mockery::mock(MetricsAggregator::class);
        $metricsAggregator->shouldReceive('push')->twice();

        $parser = new MetricsParser;
        $parser->parsePayload([
            ['event' => $event1],
            ['event' => $event2, 'data' => ['id' => 11, 'table' => 'test']],
        ], $metricsAggregator, $viewsAggregator);
    }
}
