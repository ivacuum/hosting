<?php namespace Tests\Feature;

use App\Events\Stats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BeaconTest extends TestCase
{
    use DatabaseTransactions;

    public function testEmptyEvent()
    {
        $this->post('ajax/beacon', $this->payload([['event' => '']]))
            ->assertInvalid(['events.0.event' => 'обязательно для заполнения']);
    }

    public function testInvalidPayload()
    {
        $this->post('ajax/beacon', $this->payload(['bogus' => 'is real']))
            ->assertInvalid(['events.bogus.event' => 'обязательно для заполнения']);
    }

    public function testInvalidPayloadNoEvents()
    {
        $this->post('ajax/beacon', ['bogus' => 'is real'])
            ->assertInvalid(['events' => 'обязательно для заполнения']);
    }

    public function testInvalidPayloadEventsNotJson()
    {
        $this->post('ajax/beacon', ['events' => 'not json'])
            ->assertInvalid(['events' => 'обязательно для заполнения']);
    }

    /** @dataProvider simpleEvents */
    public function testSimpleCounters(string $event)
    {
        \Event::fake($event);

        $payload = $this->payload([
            [
                'event' => class_basename($event),
            ],
        ]);

        $this->post('ajax/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched($event);
    }

    /** @dataProvider viewCounters */
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

    public function testUnknownEvent()
    {
        $this->post('ajax/beacon', $this->payload([['event' => 'unknown thing']]))
            ->assertNoContent();
    }

    public static function simpleEvents()
    {
        return [
            [Stats\NumberSpoken::class],
            [Stats\HiraganaAnswered::class],
            [Stats\HiraganaSelected::class],
            [Stats\KatakanaAnswered::class],
            [Stats\KatakanaSelected::class],
            [Stats\NumberSpeakPressed::class],
            [Stats\NumberVoiceSelected::class],
            [Stats\HiraganaAnswerRevealed::class],
            [Stats\KatakanaAnswerRevealed::class],
        ];
    }

    public static function viewCounters()
    {
        yield [
            'event' => Stats\NewsViewed::class,
            'ids' => [5, 15],
        ];

        yield [
            'event' => Stats\TorrentViewed::class,
            'ids' => [1],
        ];
    }

    private function payload(array $data): array
    {
        return ['events' => json_encode($data, \JSON_THROW_ON_ERROR)];
    }
}
