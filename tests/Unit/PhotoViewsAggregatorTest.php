<?php

namespace Tests\Unit;

use App\Domain\PhotoViewsAggregator;
use App\Factory\PhotoFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhotoViewsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExport()
    {
        $photo = PhotoFactory::new()
            ->withTrip()
            ->create();

        $aggregator = $this->app->make(PhotoViewsAggregator::class);
        $aggregator->push($photo->slug);
        $aggregator->push($photo->slug);
        $aggregator->export();

        $views = $photo->views;
        $photo->refresh();

        $this->assertSame([], $aggregator->data());
        $this->assertSame($views + 2, $photo->views);
    }

    public function testPush()
    {
        $aggregator = $this->app->make(PhotoViewsAggregator::class);
        $aggregator->push('kaluga.2020/IMG_0001.jpg');
        $aggregator->push('kaluga.2020/IMG_0001.jpg');
        $aggregator->push('msk.2022/IMG_9999.jpg');

        $this->assertSame([
            'kaluga.2020/IMG_0001.jpg' => 2,
            'msk.2022/IMG_9999.jpg' => 1,
        ], $aggregator->data());
    }
}
