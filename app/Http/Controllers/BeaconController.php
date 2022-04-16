<?php namespace App\Http\Controllers;

use App\Domain\BeaconEvent;
use App\Events\Stats;
use App\Http\Requests\BeaconStoreForm;

class BeaconController extends Controller
{
    private const METRICS = [
        Stats\HiraganaAnswered::class,
        Stats\HiraganaSelected::class,
        Stats\KatakanaAnswered::class,
        Stats\KatakanaSelected::class,
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
                default => null,
            };
        }

        return response()
            ->noContent()
            ->header('Access-Control-Allow-Origin', '*');
    }

    protected function metrics()
    {
        return collect(self::METRICS)
            ->mapWithKeys(fn ($metric) => [class_basename($metric) => $metric])
            ->toArray();
    }

    protected function processNewsViewedEvent(BeaconEvent $event)
    {
        event(new Stats\NewsViewed($event->id));
    }

    protected function processTorrentViewedEvent(BeaconEvent $event)
    {
        event(new Stats\TorrentViewed($event->id));
    }
}
