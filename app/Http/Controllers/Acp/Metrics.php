<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Metric as Model;
use Carbon\Carbon;

class Metrics extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('acp.index'), 'acp');
        \Breadcrumbs::push(trans('acp.metrics.index'));

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
        \Breadcrumbs::push(trans('acp.index'), 'acp');
        \Breadcrumbs::push(trans('acp.metrics.index'), 'acp/metrics');
        \Breadcrumbs::push($event);

        $metrics = Model::where('event', $event)->get();
        $first_day = Carbon::parse($metrics->first()->date);
        $last_day = Carbon::parse($metrics->last()->date);
        $metrics = $metrics->pluck('count', 'date');

        return view($this->view, compact('event', 'first_day', 'last_day', 'metrics'));
    }
}
