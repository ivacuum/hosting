<?php

namespace Tests\Unit;

use App\Action\HandleMetricPayloadAction;
use App\Domain\ImageViewsAggregator;
use App\Domain\MetricsAggregator;
use App\Domain\PhotoViewsAggregator;
use App\Domain\ViewsAggregator;
use App\Events\Stats\GalleryImageViewed;
use App\Events\Stats\Photo1000Viewed;
use App\Events\Stats\Photo2000Viewed;
use App\Events\Stats\Photo500Viewed;
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
        $event4 = class_basename(Photo500Viewed::class);
        $event5 = class_basename(Photo1000Viewed::class);
        $event6 = class_basename(Photo2000Viewed::class);

        $viewsAggregator = \Mockery::mock(ViewsAggregator::class);
        $viewsAggregator->expects('push');

        $metricsAggregator = \Mockery::mock(MetricsAggregator::class);
        $metricsAggregator->expects('push')->times(6);

        $imageViewsAggregator = \Mockery::mock(ImageViewsAggregator::class);
        $imageViewsAggregator->expects('push');

        $photoViewsAggregator = \Mockery::mock(PhotoViewsAggregator::class);
        $photoViewsAggregator->expects('push')->twice();

        $this->app->make(HandleMetricPayloadAction::class)->execute([
            ['event' => $event1],
            ['event' => $event2, 'data' => ['id' => 11, 'table' => 'test']],
            ['event' => $event3, 'data' => ['dateAndSlug' => '200101/1_hash.jpg']],
            ['event' => $event4, 'data' => ['slug' => 'kaluga.2020/IMG_0001.jpg']],
            ['event' => $event5, 'data' => ['slug' => 'kaluga.2020/IMG_0001.jpg']],
            ['event' => $event6, 'data' => ['slug' => 'kaluga.2020/IMG_0001.jpg']],
        ], $metricsAggregator, $viewsAggregator, $imageViewsAggregator, $photoViewsAggregator);
    }
}
