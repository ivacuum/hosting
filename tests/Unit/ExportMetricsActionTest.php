<?php

namespace Tests\Unit;

use App\Domain\Metrics\Action\ExportMetricsAction;
use Illuminate\Support\Facades\Redis;
use Predis\Command\CommandInterface;
use Tests\TestCase;

class ExportMetricsActionTest extends TestCase
{
    public function testExportsMetricsToExistingStream(): void
    {
        $metrics = [['event' => 'TripViewed', 'data' => ['table' => 'trips', 'id' => 1]]];
        $command = null;

        Redis::expects('client->executeCommand')
            ->with(\Mockery::capture($command))
            ->andReturn('1234567890-0');

        app(ExportMetricsAction::class)->execute($metrics);

        $this->assertInstanceOf(CommandInterface::class, $command);
        $this->assertSame('XADD', $command->getId());
        [$stream, $id, $field, $payload] = $command->getArguments();
        $this->assertSame(['vacuum:metrics', '*', 'json'], [$stream, $id, $field]);
        $this->assertSame($metrics, json_decode($payload, true, flags: JSON_THROW_ON_ERROR));
    }
}
