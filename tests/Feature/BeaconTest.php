<?php namespace Tests\Feature;

use App\Events\Stats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BeaconTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @dataProvider simpleEvents
     * @param string $event
     */
    public function testSimpleCounters(string $event)
    {
        $this->expectsEvents($event);

        $payload = $this->payload([[
            'event' => class_basename($event),
        ]]);

        $this->post('ajax/beacon', $payload)
            ->assertNoContent();
    }

    /**
     * @dataProvider viewCounters
     * @param string $event
     * @param array $ids
     */
    public function testViewCounters(string $event, array $ids)
    {
        $payload = $this->payload(collect($ids)->map(fn ($id) => [
            'id' => $id,
            'event' => class_basename($event),
        ])->toArray());

        \Event::fakeFor(function () use ($event, $ids, $payload) {
            $this->post('ajax/beacon', $payload)
                ->assertNoContent();

            \Event::assertDispatched($event, fn ($e) => in_array($e->id, $ids, true));
        });
    }

    public function simpleEvents()
    {
        return [
            [Stats\HiraganaAnswered::class],
            [Stats\HiraganaSelected::class],
            [Stats\KatakanaAnswered::class],
            [Stats\KatakanaSelected::class],
            [Stats\HiraganaAnswerRevealed::class],
            [Stats\KatakanaAnswerRevealed::class],
        ];
    }

    public function viewCounters()
    {
        return [[
            'event' => Stats\NewsViewed::class,
            'ids' => [5, 15],
        ], [
            'event' => Stats\TorrentViewed::class,
            'ids' => [1],
        ]];
    }

    private function payload(array $data): array
    {
        return ['events' => json_encode($data)];
    }
}
