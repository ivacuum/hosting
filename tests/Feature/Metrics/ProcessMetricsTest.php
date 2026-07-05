<?php

namespace Tests\Feature\Metrics;

use App\Console\Commands\ProcessMetrics;
use App\Domain\CacheKey;
use App\Domain\Metrics\Action\FetchMetricsAction;
use App\Domain\MetricsAggregator;
use App\Events\Stats\HiraganaSelected;
use App\Events\Stats\MySettingsChanged;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ProcessMetricsTest extends TestCase
{
    use DatabaseTransactions;

    public function testExportFailureDoesNotAdvanceCursor(): void
    {
        $this->bindFetch(collect([
            '1672531400020-0' => json_encode([['event' => class_basename(HiraganaSelected::class)]]),
        ]));

        $aggregator = $this->mock(MetricsAggregator::class);
        $aggregator->expects('push');
        $aggregator->expects('data')->andReturn([]);
        $aggregator->expects('export')->andThrow(new \RuntimeException('boom'));

        Cache::put(CacheKey::MetricsNextStartId, '0');

        $this->artisan(ProcessMetrics::class)->assertFailed();

        $this->assertSame('0', Cache::get(CacheKey::MetricsNextStartId));
        $this->assertDatabaseMissing(
            'metrics',
            ['date' => now()->toDateString(), 'event' => class_basename(HiraganaSelected::class)],
        );
    }

    public function testHappyPathAdvancesCursorToLastEntryId(): void
    {
        $metric1 = class_basename(HiraganaSelected::class);
        $metric2 = class_basename(MySettingsChanged::class);

        $this->bindFetch(collect([
            '1672531400000-0' => json_encode([['event' => $metric1]]),
            '1672531400001-0' => json_encode([['event' => $metric1]]),
            '1672531400002-0' => json_encode([['event' => $metric2]]),
        ]));

        Cache::put(CacheKey::MetricsNextStartId, '0');

        $this->artisan(ProcessMetrics::class)->assertOk();

        $this->assertSame('1672531400002-0', Cache::get(CacheKey::MetricsNextStartId));
        $this->assertDatabaseHas('metrics', ['date' => now()->toDateString(), 'event' => $metric1, 'count' => 2]);
        $this->assertDatabaseHas('metrics', ['date' => now()->toDateString(), 'event' => $metric2, 'count' => 1]);
    }

    public function testPoisonJsonThrowsAndDoesNotAdvanceCursor(): void
    {
        $metric = class_basename(HiraganaSelected::class);

        $this->bindFetch(collect([
            '1672531400010-0' => json_encode([['event' => $metric]]),
            '1672531400011-0' => '{this is not valid json',
            '1672531400012-0' => json_encode([['event' => $metric]]),
        ]));

        Cache::put(CacheKey::MetricsNextStartId, '0');

        $threw = false;
        try {
            $this->artisan(ProcessMetrics::class)->run();
        } catch (\JsonException) {
            $threw = true;
        }

        $this->assertTrue($threw, 'Expected JsonException from poison stream entry');
        $this->assertSame('0', Cache::get(CacheKey::MetricsNextStartId));
        $this->assertDatabaseMissing('metrics', [
            'date' => now()->toDateString(),
            'event' => $metric,
        ]);
    }

    private function bindFetch(Collection $stream): void
    {
        $this->mock(FetchMetricsAction::class)
            ->expects('execute')
            ->andReturn($stream);
    }
}
