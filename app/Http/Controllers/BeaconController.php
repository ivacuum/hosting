<?php namespace App\Http\Controllers;

use App\Events\Stats;
use App\Http\Requests\BeaconStoreRequest;

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

    public function __invoke(BeaconStoreRequest $request)
    {
        $metrics = $this->metrics();

        foreach ($request->input('events') as $entry) {
            if (!isset($entry['event'])) {
                continue;
            }

            $event = $entry['event'];

            if (isset($metrics[$event])) {
                event(new $metrics[$event]);
                continue;
            }

            $method = "process{$event}Event";

            if (method_exists($this, $method)) {
                $this->{$method}($entry);
            }
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

    protected function processNewsViewedEvent($event)
    {
        event(new Stats\NewsViewed($event['id']));
    }

    protected function processTorrentViewedEvent($event)
    {
        event(new Stats\TorrentViewed($event['id']));
    }
}
