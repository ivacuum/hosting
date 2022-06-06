<?php namespace Tests\Unit;

use App\Action\HandleMetricPayloadAction;
use App\Domain\ImageViewsAggregator;
use App\Domain\MetricsAggregator;
use App\Domain\ViewsAggregator;
use App\Events\Stats\GalleryImageViewed;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HandleMetricPayloadActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testParsePayload()
    {
        $event1 = 'PayloadEvent1';
        $event2 = 'PayloadEvent1Viewed';
        $event3 = class_basename(GalleryImageViewed::class);

        $viewsAggregator = \Mockery::mock(ViewsAggregator::class);
        $viewsAggregator->shouldReceive('push')->once();

        $metricsAggregator = \Mockery::mock(MetricsAggregator::class);
        $metricsAggregator->shouldReceive('push')->times(3);

        $imageViewsAggregator = \Mockery::mock(ImageViewsAggregator::class);
        $imageViewsAggregator->shouldReceive('push')->once();

        $this->app->make(HandleMetricPayloadAction::class)->execute([
            ['event' => $event1],
            ['event' => $event2, 'data' => ['id' => 11, 'table' => 'test']],
            ['event' => $event3, 'data' => ['dateAndSlug' => '200101/1_hash.jpg']],
        ], $metricsAggregator, $viewsAggregator, $imageViewsAggregator);
    }
}
