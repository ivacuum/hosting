<?php namespace App\Http\Controllers;

class AjaxBeacon extends Controller
{
    public function store()
    {
        foreach (json_decode(request('events')) as $event) {
            if (!isset($event->event)) {
                continue;
            }

            $method = "process{$event->event}Event";

            if (method_exists($this, $method)) {
                $this->{$method}($event);
            }
        }

        return response('', 200)
            ->header('Access-Control-Allow-Origin', '*');
    }

    protected function processHiraganaAnsweredEvent()
    {
        event(new \App\Events\Stats\HiraganaAnswered);
    }

    protected function processHiraganaAnswerRevealedEvent()
    {
        event(new \App\Events\Stats\HiraganaAnswerRevealed);
    }

    protected function processHiraganaSelectedEvent()
    {
        event(new \App\Events\Stats\HiraganaSelected);
    }

    protected function processKatakanaAnsweredEvent()
    {
        event(new \App\Events\Stats\KatakanaAnswered);
    }

    protected function processKatakanaAnswerRevealedEvent()
    {
        event(new \App\Events\Stats\KatakanaAnswerRevealed);
    }

    protected function processKatakanaSelectedEvent()
    {
        event(new \App\Events\Stats\KatakanaSelected);
    }

    protected function processNewsViewedEvent($event)
    {
        event(new \App\Events\Stats\NewsViewed($event->id));
    }

    protected function processTorrentViewedEvent($event)
    {
        event(new \App\Events\Stats\TorrentViewed($event->id));
    }
}
