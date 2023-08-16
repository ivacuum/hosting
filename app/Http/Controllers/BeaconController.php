<?php

namespace App\Http\Controllers;

use App\Domain\BeaconEvent;
use App\Events\Stats;
use App\Http\Requests\BeaconStoreForm;

class BeaconController
{
    private const METRICS = [
        Stats\NumberSpoken::class,
        Stats\HiraganaAnswered::class,
        Stats\HiraganaSelected::class,
        Stats\KatakanaAnswered::class,
        Stats\KatakanaSelected::class,
        Stats\NumberSpeakPressed::class,
        Stats\NumberVoiceSelected::class,
        Stats\HiraganaAnswerRevealed::class,
        Stats\KatakanaAnswerRevealed::class,
    ];

    public function __invoke(BeaconStoreForm $request)
    {
        $metrics = $this->metrics();

        foreach ($request->events as $event) {
            if (isset($metrics[$event->event])) {
                event(new $metrics[$event->event]);

                continue;
            }

            match ($event->event) {
                class_basename(Stats\NewsViewed::class) => $this->processNewsViewedEvent($event),
                class_basename(Stats\TorrentViewed::class) => $this->processTorrentViewedEvent($event),
                class_basename(Stats\Photo500Viewed::class) => $this->processPhoto500Viewed($event),
                class_basename(Stats\Photo1000Viewed::class) => $this->processPhoto1000Viewed($event),
                class_basename(Stats\Photo2000Viewed::class) => $this->processPhoto2000Viewed($event),
                default => null,
            };
        }

        return response()
            ->noContent()
            ->header('Access-Control-Allow-Origin', '*');
    }

    private function metrics()
    {
        return collect(self::METRICS)
            ->mapWithKeys(fn ($metric) => [class_basename($metric) => $metric])
            ->toArray();
    }

    private function processNewsViewedEvent(BeaconEvent $event)
    {
        event(new Stats\NewsViewed($event->id));
    }

    private function processPhoto500Viewed(BeaconEvent $event)
    {
        $slug = str($event->slug)
            ->after('/-/500x375/');

        event(new Stats\Photo500Viewed($slug));
    }

    private function processPhoto1000Viewed(BeaconEvent $event)
    {
        $slug = str($event->slug)
            ->after('/-/1000x750/');

        event(new Stats\Photo1000Viewed($slug));
    }

    private function processPhoto2000Viewed(BeaconEvent $event)
    {
        $slug = trim($event->slug, '/');

        event(new Stats\Photo2000Viewed($slug));
    }

    private function processTorrentViewedEvent(BeaconEvent $event)
    {
        event(new Stats\TorrentViewed($event->id));
    }
}
