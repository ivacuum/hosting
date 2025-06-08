<?php

namespace Tests\Feature;

use App\Events\Stats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BeaconTest extends TestCase
{
    use DatabaseTransactions;

    public function testEmptyEvent()
    {
        $this->post('js/beacon', $this->payload([['event' => '']]))
            ->assertInvalid(['events.0.event' => 'обязательно для заполнения']);
    }

    public function testInvalidPayload()
    {
        $this->post('js/beacon', $this->payload(['bogus' => 'is real']))
            ->assertInvalid(['events.bogus.event' => 'обязательно для заполнения']);
    }

    public function testInvalidPayloadNoEvents()
    {
        $this->post('js/beacon', ['bogus' => 'is real'])
            ->assertInvalid(['events' => 'обязательно для заполнения']);
    }

    public function testInvalidPayloadEventsNotJson()
    {
        $this->post('js/beacon', ['events' => 'not json'])
            ->assertInvalid(['events' => 'обязательно для заполнения']);
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('simpleEvents')]
    public function testSimpleCounters(string $event)
    {
        \Event::fake($event);

        $payload = $this->payload([
            [
                'event' => class_basename($event),
            ],
        ]);

        $this->post('js/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched($event);
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('viewCounters')]
    public function testViewCounters(string $event, array $ids)
    {
        $payload = $this->payload(collect($ids)->map(fn ($id) => [
            'id' => $id,
            'event' => class_basename($event),
        ])->toArray());

        \Event::fakeFor(function () use ($event, $ids, $payload) {
            $this->post('js/beacon', $payload)
                ->assertNoContent();

            \Event::assertDispatched($event, fn ($e) => in_array($e->id, $ids, true));
        });
    }

    public function testUnknownEvent()
    {
        $this->post('js/beacon', $this->payload([['event' => 'unknown thing']]))
            ->assertNoContent();
    }

    public static function simpleEvents()
    {
        yield [Stats\HiraganaAnswered::class];
        yield [Stats\HiraganaSelected::class];
        yield [Stats\HiraganaAnswerRevealed::class];

        yield [Stats\KatakanaAnswered::class];
        yield [Stats\KatakanaSelected::class];
        yield [Stats\KatakanaAnswerRevealed::class];

        yield [Stats\KanaAnswered::class];
        yield [Stats\KanaSelected::class];
        yield [Stats\KanaAnswerRevealed::class];

        yield [Stats\NumberSpoken::class];
        yield [Stats\NumberSpeakPressed::class];
        yield [Stats\NumberVoiceSelected::class];
    }

    public static function viewCounters()
    {
        yield [
            Stats\NewsViewed::class,
            [5, 15],
        ];

        yield [
            Stats\TorrentViewed::class,
            [1],
        ];
    }

    private function payload(array $data): array
    {
        return ['events' => json_encode($data, \JSON_THROW_ON_ERROR)];
    }
}
