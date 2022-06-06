<?php namespace Tests\Unit;

use App\Domain\ImageViewsAggregator;
use App\Factory\ImageFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImageViewsAggregatorTest extends TestCase
{
    use DatabaseTransactions;

    public function testExport()
    {
        $image = ImageFactory::new()->create();

        $this->travelTo('2020-01-01');

        $aggregator = $this->app->make(ImageViewsAggregator::class);
        $aggregator->push("{$image->date}/{$image->slug}");
        $aggregator->push("{$image->date}/{$image->slug}");
        $aggregator->export();

        $views = $image->views;
        $image->refresh();

        $this->assertSame([], $aggregator->data());
        $this->assertSame($views + 2, $image->views);
        $this->assertSame('2020-01-01 00:00:00', $image->updated_at->toDateTimeString());
    }

    public function testPush()
    {
        $aggregator = $this->app->make(ImageViewsAggregator::class);
        $aggregator->push('123456/1_abc.png');
        $aggregator->push('123456/1_abc.png');
        $aggregator->push('654321/1_top.jpg');

        $this->assertSame([
            '123456/1_abc.png' => 2,
            '654321/1_top.jpg' => 1,
        ], $aggregator->data());
    }
}
