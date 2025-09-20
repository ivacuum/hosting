<?php

namespace Tests\Feature;

use App\Events\Stats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
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

    #[TestWith([Stats\HiraganaAnswered::class])]
    #[TestWith([Stats\HiraganaSelected::class])]
    #[TestWith([Stats\HiraganaAnswerRevealed::class])]
    #[TestWith([Stats\KatakanaAnswered::class])]
    #[TestWith([Stats\KatakanaSelected::class])]
    #[TestWith([Stats\KatakanaAnswerRevealed::class])]
    #[TestWith([Stats\KanaAnswered::class])]
    #[TestWith([Stats\KanaSelected::class])]
    #[TestWith([Stats\KanaAnswerRevealed::class])]
    #[TestWith([Stats\NumberSpoken::class])]
    #[TestWith([Stats\NumberSpeakPressed::class])]
    #[TestWith([Stats\NumberVoiceSelected::class])]
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

    #[TestWith([Stats\NewsViewed::class, [5, 15]])]
    #[TestWith([Stats\TorrentViewed::class, [1]])]
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

    private function payload(array $data): array
    {
        return ['events' => json_encode($data, \JSON_THROW_ON_ERROR)];
    }
}
