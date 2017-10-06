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

        return response('', 204);
    }

    protected function processNewsViewedEvent($event)
    {
        event(new \App\Events\Stats\NewsViewed($event->id));
    }
}
