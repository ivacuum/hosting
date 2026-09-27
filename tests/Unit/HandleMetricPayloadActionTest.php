<?php

namespace Tests\Unit;

use App\Action\HandleMetricPayloadAction;
use App\Domain\ImageViewsAggregator;
use App\Domain\Life\PhotoViewsAggregator;
use App\Domain\MetricsAggregator;
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

    public function testRoutesEachPayloadToTheCorrectAggregator(): void
    {
        $event1 = 'PayloadEvent1';
        $event2 = 'PayloadEvent1Viewed';
        $event3 = class_basename(GalleryImageViewed::class);
        $event4 = class_basename(Photo500Viewed::class);
        $event5 = class_basename(Photo1000Viewed::class);
        $event6 = class_basename(Photo2000Viewed::class);

        $viewsAggregator = \Mockery::mock(ViewsAggregator::class);
        $viewsAggregator->expects('push')->with('test', 11);

        $metricsAggregator = \Mockery::mock(MetricsAggregator::class);
        foreach ([$event1, $event2, $event3, $event4, $event5, $event6] as $event) {
            $metricsAggregator->expects('push')->with($event);
        }

        $imageViewsAggregator = \Mockery::mock(ImageViewsAggregator::class);
        $imageViewsAggregator->expects('push')->with('200101/1_hash.jpg');

        $photoViewsAggregator = \Mockery::mock(PhotoViewsAggregator::class);
        $photoViewsAggregator->expects('push')->with('kaluga.2020/IMG_1000.jpg');
        $photoViewsAggregator->expects('push')->with('kaluga.2020/IMG_2000.jpg');

        $this->app->make(HandleMetricPayloadAction::class)->execute([
            ['event' => $event1],
            ['event' => $event2, 'data' => ['id' => 11, 'table' => 'test']],
            ['event' => $event3, 'data' => ['dateAndSlug' => '200101/1_hash.jpg']],
            ['event' => $event4, 'data' => ['slug' => 'kaluga.2020/IMG_0500.jpg']],
            ['event' => $event5, 'data' => ['slug' => 'kaluga.2020/IMG_1000.jpg']],
            ['event' => $event6, 'data' => ['slug' => 'kaluga.2020/IMG_2000.jpg']],
        ], $metricsAggregator, $viewsAggregator, $imageViewsAggregator, $photoViewsAggregator);
    }
}
