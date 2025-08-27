<?php

namespace Tests\Feature\Metrics;

use App\Domain\Metrics\Action\PushMetricAction;
use App\Domain\Metrics\Listener\WildcardMetricsListener;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WildcardMetricsListenerTest extends TestCase
{
    use DatabaseTransactions;

    public function testDynamicEvent()
    {
        $event = new \App\Events\Stats\TripViewed(id: 1);

        $this
            ->mock(PushMetricAction::class)
            ->expects('execute')
            ->withArgs([[
                'event' => 'TripViewed',
                'data' => $event,
            ]]);

        \Event::listen(['App\Events\Stats\*'], WildcardMetricsListener::class);

        event($event);

        $this->assertSame('trips', $event->table);
        $this->assertSame(1, $event->id);
        $this->assertSame('{"table":"trips","id":1}', json_encode($event));
    }

    public function testStaticEvent()
    {
        $event = new \App\Events\Stats\YoutubeOpened;

        $this
            ->mock(PushMetricAction::class)
            ->expects('execute')
            ->withArgs([[
                'event' => 'YoutubeOpened',
                'data' => $event,
            ]]);

        \Event::listen(['App\Events\Stats\*'], WildcardMetricsListener::class);

        event($event);

        $this->assertSame('{}', json_encode($event));
    }
}
