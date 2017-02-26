<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Metric as Model;

class Metrics extends Controller
{
    public function index()
    {
        $events = Model::possibleMetrics();
        $metrics = $dates = [];

        Model::week()->get()->map(function ($item) use (&$metrics, &$dates) {
            $dates[$item->date] = true;
            $metrics[$item->event][$item->date] = $item->count;
        });

        return view($this->view, compact('dates', 'events', 'metrics'));
    }

    public function show($event)
    {
        $metrics = Model::where('event', $event)->get();
        $first_day = $metrics->first()->date;
        $last_day = $metrics->last()->date;
        $metrics = $metrics->pluck('count', 'date');

        return view($this->view, compact('event', 'first_day', 'last_day', 'metrics'));
    }
}
