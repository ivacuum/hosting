<?php

namespace Tests\Feature;

use App\Events\Stats;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class BeaconTest extends TestCase
{
    use DatabaseTransactions;

    public function testBrowserPayloadWithCsrfTokenIsAccepted()
    {
        \Event::fake(Stats\YoutubeOpened::class);

        $payload = $this->payload([['event' => 'YoutubeOpened']]);
        $payload['_token'] = csrf_token();

        $this->post('js/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched(Stats\YoutubeOpened::class);
    }

    public function testEmptyEvent()
    {
        $this->post('js/beacon', $this->payload([['event' => '']]))
            ->assertInvalid(['events.0.event' => 'обязательно для заполнения']);
    }

    public function testEveryPayload()
    {
        \Event::fake([
            Stats\YoutubeOpened::class,
            Stats\NewsViewed::class,
            Stats\Photo2000Viewed::class,
        ]);

        $payload = $this->payload([
            ['event' => 'YoutubeOpened'],
            ['event' => 'NewsViewed', 'id' => 123],
            ['event' => 'Photo2000Viewed', 'slug' => '/prague.2017.05/IMG_0128.jpg'],
        ]);

        $this->post('js/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched(Stats\YoutubeOpened::class);
        \Event::assertDispatched(Stats\NewsViewed::class, static fn (Stats\NewsViewed $event) => $event->id === 123);
        \Event::assertDispatched(Stats\Photo2000Viewed::class, static fn (Stats\Photo2000Viewed $event) => $event->slug === 'prague.2017.05/IMG_0128.jpg');
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

    #[TestWith([Stats\Photo500Viewed::class, '/-/500x375/prague.2017.05/IMG_0128.jpg', 'prague.2017.05/IMG_0128.jpg'])]
    #[TestWith([Stats\Photo1000Viewed::class, '/-/1000x750/prague.2017.05/IMG_0128.jpg', 'prague.2017.05/IMG_0128.jpg'])]
    #[TestWith([Stats\Photo2000Viewed::class, '/prague.2017.05/IMG_0128.jpg', 'prague.2017.05/IMG_0128.jpg'])]
    public function testPhotoViewCounters(string $event, string $rawSlug, string $processedSlug)
    {
        \Event::fake($event);

        $payload = $this->payload([
            [
                'event' => class_basename($event),
                'slug' => $rawSlug,
            ],
        ]);

        $this->post('js/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched($event, static fn ($e) => $e->slug === $processedSlug);
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
    #[TestWith([Stats\YoutubeOpened::class])]
    #[TestWith([Stats\YoutubeClosed::class])]
    public function testSimpleCounters(string $event)
    {
        \Event::fake($event);

        $payload = $this->payload([['event' => class_basename($event)]]);

        $this->post('js/beacon', $payload)
            ->assertNoContent();

        \Event::assertDispatched($event);
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
